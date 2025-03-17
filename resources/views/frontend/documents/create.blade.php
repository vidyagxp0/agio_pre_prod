@extends('frontend.layout.main')
@section('container')
  <!-- Include Choices.js CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <!-- Include Choices.js -->
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>


    <style>
        #fr-logo {
            display: none;
        }

        .fr-logo {
            display: none;
        }

        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }

        .group-input table input,
        .group-input table select {
            border: 0;
            margin: 0 !important;
            padding: 0 !important;
        }

        .sop-type-header {
            display: grid;
            grid-template-columns: 135px 1fr;
            border: 2px solid #000000;
            margin-bottom: 20px;
        }

        .main-head {
            display: grid;
            place-items: center;
            align-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            border-left: 2px solid #000000;
        }

        .sub-head-2 {
            text-align: center;
            background: #4274da;
            margin-bottom: 20px;
            padding: 10px 20px;
            font-size: 1.5rem;
            color: #fff;
            border: 2px solid #000000;
            border-radius: 40px;
        }

        #displayField {
            border: 1px solid #f0f0f0;
            background: white;
            padding: 20px;
            position: relative;
            display: flex;
            align-items: center;
        }

        #displayField li {
            margin-left: 1rem;
            background-color: #f0f0f0;
            padding: 5px;
        }

        .close-icon {
            color: red;
            margin-left: auto;
            /* Pushes the icon to the right */
            cursor: pointer;
        }
        .hidden-tabs {
            display: none;
        }

    </style>
    <style>
        .tab {
            display: flex; /* Flexbox layout */
            flex-wrap: wrap; /* Tabs will wrap to the next line if needed */
            gap: 10px; /* Space between tabs */
            background-color: #f1f1f1; /* Optional background for better visibility */
            padding: 10px; /* Padding around the tab container */
            border: 1px solid #ccc; /* Optional border for styling */
        }

        .tab button {
            padding: 10px 15px; /* Padding inside each button */
            border: 1px solid #ccc; /* Border for each button */
            background-color: #fff; /* Button background color */
            cursor: pointer;
            border-radius: 5px; /* Rounded corners */
            transition: all 0.3s ease; /* Smooth transition for hover effects */
        }

        .tab button:hover {
            background-color: #ddd; /* Button hover effect */
        }

        .tab button.active {
            background-color: #007bff; /* Active tab background */
            color: white;
        }

        .printdoc {
            margin-left: auto; /* Push the print button to the right */
        }
    </style>
    <style>
        .choices__list--multiple .choices__item{
            display: inline-block;
            vertical-align: middle;
            border-radius: 20px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 500;
            margin-right: 3.75px;
            margin-bottom: 3.75px;
            background-color: #00bcd4;
            border: 1px solid #00a5bb;
            color: #fff;
            word-break: break-all;

        }

    </style>

    <style>

        /*Main Table Styling */
        #isPasted {
            width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed; /* Adjusts column width dynamically */
        }

        /* First column adjusts to its content */
        #isPasted td:first-child,
        #isPasted th:first-child {
            white-space: nowrap; /* Prevent wrapping */
            width: 1%; /* Shrink to fit content */
            vertical-align: top;
        }

        /* Second column takes remaining space */
        #isPasted td:last-child,
        #isPasted th:last-child {
            width: auto; /* Take remaining space */
            vertical-align: top;

        }

        /* Common Table Cell Styling */
        #isPasted th,
        #isPasted td {
            border: 1px solid #000 !important;
            padding: 8px;
            text-align: left;
            max-width: 500px;

        }

        /* Paragraph Styling Inside Table Cells */
        #isPasted td > p {
            text-align: justify;
            text-justify: inter-word;
            margin: 0;
            max-width: 500px;

        }

        #isPasted img {
            max-width: 500px !important; /* Ensure image doesn't overflow the cell */
            height: 100%; /* Maintain image aspect ratio */
            display: block; /* Remove extra space below the image */
            margin: 5px auto; /* Add spacing and center align */
        }

        /* If you want larger images */
        #isPasted td img {
                max-width: 400px !important; /* Adjust this to your preferred maximum width */
                height: 300px;
                margin: 5px auto;
            }
    </style>


    {{-- <script>
        function handleDocumentTypeChange(selectElement) {
            // Get the selected value
            const selectedType = selectElement.value;

            // Get all hidden tabs
            const tabs = document.querySelectorAll('.hidden-tabs');

            // Hide all tabs initially
            tabs.forEach(tab => {
                tab.style.display = 'none'; // Hide all tabs with "hidden-tabs" class
            });

            // Show the matching tab
            tabs.forEach(tab => {
                const tabType = tab.getAttribute('data-id');
                if (tabType === selectedType) {
                    tab.style.display = 'block'; // Show the matching tab
                }
            });
        }
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdowns = ["#reviewers-dropdown", "#approvers-dropdown", "#hods-dropdown"];

            dropdowns.forEach(selector => {
                new Choices(selector, {
                    removeItemButton: true,
                    searchEnabled: true,
                    placeholderValue: "Select options",
                    allowHTML: true,
                });
            });
        });
    </script>

    <script>
        function handleDocumentTypeChange(selectElement) {
            // Get the selected value
            const selectedType = selectElement.value;

            // Get all hidden tabs
            const tabs = document.querySelectorAll('.hidden-tabs');

            // Hide all tabs initially
            tabs.forEach(tab => {
                tab.style.display = 'none'; // Hide all tabs with "hidden-tabs" class
            });

            // Show the matching tab
            tabs.forEach(tab => {
                const tabType = tab.getAttribute('data-id');
                if (tabType === selectedType) {
                    tab.style.display = 'block'; // Show the matching tab
                }
            });

            // Update the document type code display
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            document.getElementById('document_type_code').innerText = selectedOption.value || "Not selected";
        }
    </script>

    
    <?php $division_id = isset($_GET['id']) ? $_GET['id'] : ''; ?>
    <div id="data-field-head">
        <div class="pr-id">
            New Document
        </div>
        @if (isset($_GET['id']))
            <div class="division-bar">
                <strong>Site Division/Project</strong> :
                {{ Helpers::getDivisionName($_GET['id']) }} / Document
                {{-- {{ $division->dname }} / {{ $division->pname }} --}}
            </div>
        @endif
    </div>

    <div id="data-fields">

        <div class="container-fluid">
            <div class="tab">
                <button class="tablinks active" onclick="openData(event, 'doc-info')" id="defaultOpen">Document
                 information</button>
                <button class="tablinks" onclick="openData(event, 'add-doc')">Training Information</button>
                <button class="tablinks hidden-tabs" data-id="SOP" onclick="openData(event, 'doc-content')">Document Content</button>
                <!-- Tabs that should be hidden initially -->
                <button class="tablinks hidden-tabs" data-id="FPS" onclick="openData(event, 'doc_FPS')">Finished Product Specification</button>
                <button class="tablinks hidden-tabs" data-id="INPS" onclick="openData(event, 'doc_INPS')">Inprocess Specification</button>
                <button class="tablinks hidden-tabs" data-id="CVS" onclick="openData(event, 'doc_CVS')">Cleaning Validation Specification</button>

                <button class="tablinks hidden-tabs" data-id="FPSTP" onclick="openData(event, 'doc-fpstp')">Finished Product Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="INPSTP" onclick="openData(event, 'doc-istp')">Inprocess Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="CVSTP" onclick="openData(event, 'doc-cvstp')">Cleaning Validation Standard Testing Procedure</button>

                <button class="tablinks hidden-tabs" data-id="TEMPMAPPING" onclick="openData(event, 'doc-tempmapping')">Temperature Mapping Report</button>
                <button class="tablinks hidden-tabs" data-id="HOLDTIMESTUDYPROTOCOL" onclick="openData(event, 'doc-htsp')">Hold Time Study Protocol</button>

                <button class="tablinks hidden-tabs" data-id="PACKVALIPROTOCOL" onclick="openData(event, 'doc-pvp')">Packing validation Protocol</button>

                <button class="tablinks hidden-tabs" data-id="ANNACINQULIPROTOCOL" onclick="openData(event, 'doc-AIQP')">Annexure For Acceptance Of Installation Qualification Protocol</button>
                <button class="tablinks hidden-tabs" data-id="ANNACOPERQULIPROTOCOL" onclick="openData(event, 'doc-AOQP')">Annexure For Acceptance Of Operational Qualification Protocol</button>
                <button class="tablinks hidden-tabs" data-id="ANNACPERMQULIPROTOCOL" onclick="openData(event, 'doc-APQP')">Annexure For Acceptance Of Performance Qualification Protocol</button>

                <button class="tablinks hidden-tabs" data-id="PACKVALIREPORT" onclick="openData(event, 'doc-PacValRep')">Packing Validation Report</button>
                <button class="tablinks hidden-tabs" data-id="FOCONITOGENPROTOCOL" onclick="openData(event, 'doc-FoCoANGsP')">Format For Compressed Air And Nitrogen Gas System Protocol</button>

                <button class="tablinks hidden-tabs" data-id="RAWMS" onclick="openData(event, 'doc-rawms')">Raw Material Specification</button>

                <button class="tablinks hidden-tabs" data-id="RMSTP" onclick="openData(event, 'doc_rmstp')">Raw Material Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="PAMS" onclick="openData(event, 'doc_pams')">Packing Material Specification</button>
                <button class="tablinks hidden-tabs" data-id="PROVALIPROTOCOL" onclick="openData(event, 'doc_prvp')">Process Validation Protocol</button>

                <button class="tablinks hidden-tabs" data-id="PIAS" onclick="openData(event, 'doc_pias')">Product / Item Information-Addendum Specification</button>
                <button class="tablinks hidden-tabs" data-id="TDS" onclick="openData(event, 'doc-tds')">Test Data Sheet</button>
                <button class="tablinks hidden-tabs" data-id="GTP" onclick="openData(event, 'doc-gtp')">General Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="MFPS" onclick="openData(event, 'doc-mfps')">Master Finished Product Specification</button>
                <button class="tablinks hidden-tabs" data-id="MFPSTP" onclick="openData(event, 'doc-mfpstp')">Master Finished Product Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="STUDY" onclick="openData(event, 'doc-study')">Study Report</button>

                <button class="tablinks hidden-tabs" data-id="STUDYPROTOCOL" onclick="openData(event, 'doc-stprotocol')">Study Protocol</button>
                <button class="tablinks hidden-tabs" data-id="EQUIPMENTHOLDREPORT" onclick="openData(event, 'doc-eqpreport')">Equipment Hold Time Study Report</button>

                <button class="tablinks hidden-tabs" data-id="EQUIPMENTHOLDPROTOCOL" onclick="openData(event, 'doc-eqpprotocol')">Equipment Hold Time Study Protocol</button>
                <button class="tablinks hidden-tabs" data-id="FOCONITOGENREPORT" onclick="openData(event, 'doc-fcreport')">Format for compressed air and Nitrogen gas system Report</button>

                <button class="tablinks hidden-tabs" data-id="PROVALIDRE" onclick="openData(event, 'doc_pvr')">Process Validation Report</button>
                <button class="tablinks hidden-tabs" data-id="CLEAVALIPROTODOC" onclick="openData(event, 'doc_cvpd')">Cleaning Validation Protocol.doc</button>

                <button class="tablinks hidden-tabs" data-id="CLEAVALIREPORTDOC" onclick="openData(event, 'doc_cvrd')">Cleaning Validation Report.doc</button>
                <button class="tablinks hidden-tabs" data-id="QUALIPROCUMREP" onclick="openData(event, 'doc_qpcr')">Qualification Protocol Cum Report</button>

                <button class="tablinks hidden-tabs" data-id="STABILITYPROTOCOL" onclick="openData(event, 'doc_ssp')">STABILITY STUDY PROTOCOL</button>
                <button class="tablinks hidden-tabs" data-id="VMP" onclick="openData(event, 'doc_vmp')">Validation Master Plan</button>

                <button class="tablinks hidden-tabs" data-id="QM" onclick="openData(event, 'doc_qm')">Quality Manual </button>


                <button class="tablinks hidden-tabs" data-id="PROVALIINTERRE" onclick="openData(event, 'doc_proc_interim')">Process Validation Interim Report</button>

                <button class="tablinks hidden-tabs" data-id="ANNIGxPASSES" onclick="openData(event, 'doc_Annexure_I')">Annexure I-Gxp Assessment</button>
                <button class="tablinks hidden-tabs" data-id="ANNIIRiskASSES" onclick="openData(event, 'doc_Annexure_II')">Annexure II-Initial Risk Assessment</button>
                <button class="tablinks hidden-tabs" data-id="ANNIIIERESASSES" onclick="openData(event, 'doc_Annexure_III')">Annexure III-ERES Assessment</button>
                <button class="tablinks hidden-tabs" data-id="ANNIVPlanASSES" onclick="openData(event, 'doc_Annexure_IV')">Annexure IV-Validation Plan</button>
                <button class="tablinks hidden-tabs" data-id="ANNVUserReqSpe" onclick="openData(event, 'doc_Annexure_V')">Annexure V-User Requirements Specification</button>
                <button class="tablinks hidden-tabs" data-id="ANNVIFunReqSpe" onclick="openData(event, 'doc_Annexure_VI')">Annexure VI-Functional Requirement Specification</button>
                <button class="tablinks hidden-tabs" data-id="ANNVIIFunSpe" onclick="openData(event, 'doc_Annexure_VII')">Annexure VII-Functional Specification</button>
                <button class="tablinks hidden-tabs" data-id="ANNVIIITechSpe" onclick="openData(event, 'doc_Annexure_VIII')">Annexure VIII-Technical Specification</button>
                <button class="tablinks hidden-tabs" data-id="ANNIXFunRiskASSES" onclick="openData(event, 'doc_Annexure_IX')">Annexure IX Functional Risk Assssment</button>
                <button class="tablinks hidden-tabs" data-id="ANNXDesignSpe" onclick="openData(event, 'doc_Annexure_X')">Annexure X-Design Specification</button>

                <button class="tablinks hidden-tabs" data-id="ANNXIConfiSpe" onclick="openData(event, 'doc_Annexure_XI')">Annexure XI Configuration Specification</button>
                <button class="tablinks hidden-tabs" data-id="ANNXIIQualiProto" onclick="openData(event, 'doc_Annexure_XII')">Annexure XII Installation Infrastructure Operational Performance Qualification Protocol</button>
                <button class="tablinks hidden-tabs" data-id="ANNXIIIUnitInTest" onclick="openData(event, 'doc_Annexure_XIII')">Annexure XIII Unit Integration Test Script</button>
                <button class="tablinks hidden-tabs" data-id="ANNXIVDataMigPro" onclick="openData(event, 'doc_Annexure_XIV')">Annexure XIV Data Migration Protocol</button>
                <button class="tablinks hidden-tabs" data-id="ANNXVPerfQualif" onclick="openData(event, 'doc_Annexure_XV')">Annexure XV Data Qualification Protocol</button>

                <button class="tablinks hidden-tabs" data-id="ANNEQUALPROTO" onclick="openData(event, 'doc-afqp')">Annexure For Qualification Protocol</button>
                <button class="tablinks hidden-tabs" data-id="ANNEQUALREPORT" onclick="openData(event, 'doc-afqr')">Annexure For Qualification Report</button>
                <button class="tablinks hidden-tabs" data-id="AAEUSERREQUESPECI" onclick="openData(event, 'doc-afurs')">Annexure For User Requirement Specification</button>
                <button class="tablinks hidden-tabs" data-id="REQULIFICATIONPROTOCOL" onclick="openData(event, 'doc-aqp')">Area Qualification Protocol</button>
                <button class="tablinks hidden-tabs" data-id="AREAQUALIFICATIONREPORT" onclick="openData(event, 'doc-aqr')">Area Qualification Report</button>
                <button class="tablinks hidden-tabs" data-id="PROTOCOLFORMEDIAFILL" onclick="openData(event, 'doc-pfmf')">Protocol For Media Fill</button>
                <button class="tablinks hidden-tabs" data-id="REPORTFORMEDIAFILL" onclick="openData(event, 'doc-rfmf')">Report For Media Fill</button>

                <button class="tablinks hidden-tabs" data-id="ANNEXUREXIXSYSTEMRETIREMENT" onclick="openData(event, 'doc-asr')">annexure-XIX - System Retirement</button>
                <button class="tablinks hidden-tabs" data-id="ANNEXUREXVIIITRACEABILITYMATRIX" onclick="openData(event, 'doc-atm')">annexure-XVIII - Traceability Matrix</button>
                <button class="tablinks hidden-tabs" data-id="ANNEXUREXVIIVALIDATION" onclick="openData(event, 'doc-avsr')">annexure-XVII - Validation Summary Report </button>
                <button class="tablinks hidden-tabs" data-id="ANNEXUREXVIINSTALLATION" onclick="openData(event, 'doc-aiiopq')">annexure-XVI - Installation_Infrastructure_Operational_Performance Qualification</button>

                <button class="tablinks hidden-tabs" data-id="HOLDTIMESTUDYREPORT" onclick="openData(event, 'doc-holdtimstduy')">Hold Time Study Report</button>
                <button class="tablinks hidden-tabs" data-id="BOM" onclick="openData(event, 'doc-billofmaterial')">Bill Of Material</button>
                <button class="tablinks hidden-tabs" data-id="BMR" onclick="openData(event, 'doc-manufacturingRecord')">Batch Manufacturing Record (BMR)</button>
                <button class="tablinks hidden-tabs" data-id="MAForRec" onclick="openData(event, 'doc-masterformulaRecord')">Master Formula Record</button>
                <button class="tablinks hidden-tabs" data-id="MAPacRec" onclick="openData(event, 'doc-masterPackingRecord')">Master Packing Record</button>
                <button class="tablinks hidden-tabs" data-id="SMF" onclick="openData(event, 'doc-SiteMasterFile')">Site Master File (SMF)</button>

                <button class="tablinks" onclick="openData(event, 'annexures')">Annexures</button>
                <button class="tablinks" onclick="openData(event, 'distribution-retrieval')">Distribution & Retrieval</button>
                <button class="tablinks" onclick="openData(event, 'sign')">Signature</button>
                <button class="tablinks printdoc" style="float: right;" onclick="window.print();return false;">Print</button>
            </div>



            <form id="document-form" action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div id="step-form">
                    <!-- Tab content -->
                    <div id="doc-info" class="tabcontent">

                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="group-input">
                                        <label for="originator">Originator</label>
                                        <div class="default-name">{{ Auth::user()->name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="group-input">
                                        <label for="open-date">Date Opened</label>
                                        <div class="default-name"> {{ date('d-M-Y') }}</div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="group-input">
                                        <label for="record-num">Record Number</label>
                                        <div class="default-name">{{ $recordNumber }}
                                </div>
                            </div>
                        </div> --}}


                                <div class="col-lg-12">
                                    <div class="group-input">
                                        @if (isset($_GET['id']))
                                            <label for="Division Code"><b>Site/Location Code</b></label>
                                            <input readonly type="text" name="division_id"
                                                value="{{ Helpers::getDivisionName($_GET['id']) }}">
                                            <input type="hidden" name="division_id" value="{{ $_GET['id'] }}">
                                            {{-- <div class="static">{{ Helpers::getDivisionName(session()->get('division')) }}
                                    </div> --}}
                                        @else
                                            <label for="Division Code"><b>Site/Location Code </b></label>
                                            {{-- <input readonly type="text" name="division_id"
                                            value="">
                                        <input type="hidden" name="division_id" value=""> --}}
                                            <input readonly type="text" name="division_code"
                                                value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                            <input type="hidden" name="division_id"
                                                value="{{ session()->get('division') }}">
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="document_name-desc">Document Name<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="document_name" maxlength="255" required>
                                    </div>
                                    <p id="docnameError" style="color:red">**Document Name is required</p>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description<span class="text-danger">*</span></label>
                                        <span id="new-rchars">255</span>
                                        characters remaining
                                        <input type="text" id="short_desc" name="short_desc" maxlength="255">
                                    </div>
                                    <p id="short_descError" style="color:red">**Short description is required</p>
                                </div> --}}

                                <div class="col-md-12" id="docNameContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="document_name-desc">Document Name<span class="text-danger" id="docNameRequired" style="display: none;">*</span></label>
                                        <span id="rchars">255</span> characters remaining
                                        <input id="docname" type="text" maxlength="255">
                                    </div>
                                    <p id="docnameError" style="color:red; display: none;">**Document Name is required</p>
                                </div>

                                <!-- Short Description (Initially Hidden) -->
                                <div class="col-md-12" id="shortDescContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description<span class="text-danger" id="shortDescRequired" style="display: none;">*</span></label>
                                        <span id="new-rchars">255</span> characters remaining
                                        <input type="text" id="short_desc" name="short_desc" maxlength="255">
                                    </div>
                                    <p id="short_descError" style="color:red; display: none;">**Short description is required</p>
                                </div>

                                <div class="col-md-12" id="sopTypeContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="sop_type">SOP Type<span class="text-danger" id="sopTypeRequired" style="display: none;">*</span></label>
                                        <select name="sop_type" id="sop_type" onchange="updateSopTypeShort()">
                                            <option value="" disabled selected>Enter your selection</option>
                                            <option value="SOP (Standard Operating procedure)">SOP (Standard Operating procedure)</option>
                                            <option value="EOP (Equipment Operating procedure)">EOP (Equipment Operating procedure)</option>
                                            <option value="IOP (Instrument Operating Procedure)">IOP (Instrument Operating Procedure)</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="sop_type_short" id="sop_type_short">

                                <div class="col-md-4 new-date-data-field" id="dueDateContainer" style="display: none;">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger" id="dueDateRequired" style="display: none;">*</span></label>
                                        <div><small class="text-primary">Kindly Fill Target Date of Completion</small>
                                        </div>
                                        <div class="calenderauditee">
                                            <input type="text" name="due_dateDoc" id="due_dateDoc" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" id="due_dateDoc" name="due_dateDoc"
                                                pattern="\d{4}-\d{2}-\d{2}" class="hide-input"
                                                min="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                                oninput="handleDateInput(this, 'due_dateDoc')" />
                                        </div>
                                    </div>
                                    <p id="due_dateDocError" style="color:red; display: none;">**Due Date is required</p>

                                </div>

                                <div class="col-md-8" id="notifyContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="notify_to">Notify To</label>
                                        <select multiple name="notify_to[]" placeholder="Select Persons"
                                            data-search="false" data-silent-initial-value-set="true" id="notify_to">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="orig-head">
                            Document Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6" id="docnoContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="doc-num">Document Number</label>
                                        <div class="default-name">Not available</div>
                                    </div>
                                </div>

                                <div class="col-md-6" id="legacyContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="legacy_number">Legacy Document Number</label>
                                        <input type="text" id="legacy_number" name="legacy_number" maxlength="255">
                                    </div>
                                </div>

                                <div class="col-md-12" id="refContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="link-doc">Reference Record</label>
                                        <select multiple name="reference_record[]" placeholder="Select Reference Records"
                                            data-search="false" data-silent-initial-value-set="true"
                                            id="reference_record">
                                            @if (!empty($document))
                                                @foreach ($document as $temp)
                                                    <option value="{{ $temp->id }}">

                                                        {{ $temp->sop_type_short }}/{{ $temp->department_id }}/000{{ $temp->id }}/R{{ $temp->major }}.{{ $temp->minor }}/{{ $temp->document_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6" id="departContainer">
                                    <div class="group-input">
                                        <label for="depart-name">Department Name<span class="text-danger">*</span></label>
                                        <select name="department_id" id="depart-name" required>
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach (Helpers::getDmsDepartments() as $code => $department)
                                                <option value="{{ $code }}">{{ $department }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <p id="depart-nameError" style="color:red; display: none;">** Department is required</p> --}}
                                </div>

                                <div class="col-6" id="docVerContainer" style="display: none">
                                    <div class="group-input">
                                        <label for="major">Document Version <small>(Major)</small> <span
                                                class="text-danger">*</span>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-management-system-modal"
                                                style="font-size: 0.8rem; font-weight: 400;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <input type="number" name="major" id="major" min="0" required>
                                    </div>
                                </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-type">Document Type<span class="text-danger">*</span></label>
                                    <select name="document_type_id" id="doc-type" required onchange="handleDocumentSelection(this)">
                                        <option value="" selected>Enter your Selection</option>
                                        @foreach (Helpers::getDocumentTypes() as $code => $type)
                                            <option value="{{ $code }}">
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <p id="doc-typeError" style="color:red">** Department is required</p>
                            </div>

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="doc-code">Document Type Code</label>
                                    <div class="default-name"><span id="document_type_code">Not selected</span></div>
                                </div>
                            </div>

                                <div class="col-md-6" id="docLangContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="doc-lang">Document Language</label>
                                        <select name="document_language_id" id="doc-lang">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach ($documentLanguages as $lan)
                                                <option data-id="{{ $lan->lcode }}" value="{{ $lan->id }}">
                                                    {{ $lan->lname }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="docLangCodeContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="doc-lang">Document Language Code</label>
                                        <div class="default-name"><span id="document_language">Not selected</span></div>
                                    </div>
                                </div>

                                <div class="col-md-12" id="keywordsContainer" style="display: none;">
                                    <div class="group-input">
                                        <label for="keyword">Keywords</label>
                                        <div class="add-keyword">
                                            <input type="text" id="sourceField" class="mb-0" maxlength="15">
                                            <button id="addButton" type="button">ADD</button>
                                        </div>
                                        <ul id="displayField"></ul>
                                        <select name="keywords[]" class="targetField" multiple id="keywords"
                                            style="display: none">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-5 new-date-data-field" id="effectiveContainer" style="display: none;">
                                    <div class="group-input input-date">
                                        <label for="effective-date">Effective Date</label>
                                        <div> <small class="text-primary">The effective date will be automatically
                                                populated once the record becomes effective</small></div>
                                        <div class="calenderauditee">
                                            <input type="text" name="effective_date" id="effective_date"
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="effective_date" id="effective_date"
                                                class="hide-input" min="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                                oninput="handleDateInput(this, 'effective_date')" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 new-date-data-field" id="reviewContainer" style="display: none;">
                                    <div class="group-input ">
                                        <label for="review-period">Review Period (in years)</label>

                                        <input type="number" name="review_period" id="review_period"
                                            style="margin-top: 25px;" value="3" min="0"
                                            oninput="validateInput(this)">
                                    </div>
                                </div>
                                <script>
                                    function validateInput(input) {
                                        if (input.value < 0) {
                                            input.value = 0;
                                        }
                                    }
                                </script>

                                <div class="col-md-5 new-date-data-field" id="nextReviewContainer" style="display: none;">
                                    <div class="group-input input-date">
                                        <label for="next_review_date">Next Review Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" name="next_review_date" id="next_review_date"
                                                style="margin-top: 25px;" class="new_review_date_show" readonly
                                                placeholder="DD-MMM-YYYY" />
                                            <input type="date" name="next_review_date" id="next_review_date"
                                                class="hide-input new_review_date_hide" readonly
                                                min="{{ Carbon\Carbon::today()->format('Y-m-d') }}"
                                                oninput="handleDateInput(this, 'next_review_date')" />
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    var maxLength = 255;

                                    function handleDocumentSelection(selectElement) {
                                        // Get selected value
                                        const selectedType = selectElement.value;

                                        // Get all hidden tabs
                                        const tabs = document.querySelectorAll('.hidden-tabs');

                                        // Hide all tabs initially
                                        tabs.forEach(tab => {
                                            tab.style.display = 'none';
                                        });

                                        // Show the matching tab
                                        tabs.forEach(tab => {
                                            if (tab.getAttribute('data-id') === selectedType) {
                                                tab.style.display = 'block';
                                            }
                                        });


                                        // Update document type code display
                                        document.getElementById('document_type_code').innerText = selectElement.value || "Not selected";

                                        // Handle field validation and visibility
                                        const shortDescContainer = document.getElementById('shortDescContainer');
                                        const shortDescInput = document.getElementById('short_desc');

                                        const docNameContainer = document.getElementById('docNameContainer');
                                        const docNameInput = document.getElementById('docname');

                                        const sopTypeContainer = document.getElementById('sopTypeContainer');
                                        const sopType = document.getElementById('sop_type');

                                        const dueDateContainer = document.getElementById('dueDateContainer');
                                        const dueDateInput = document.getElementById('due_dateDoc');

                                        // const departContainer = document.getElementById('departContainer');
                                        // const departInput = document.getElementById('depart-name');

                                        const docVerContainer = document.getElementById('docVerContainer');
                                        const majorInput = document.getElementById('major');

                                        const notifyContainer = document.getElementById('notifyContainer');
                                        const keywordContainer = document.getElementById('keywordsContainer');

                                        const docLangContainer = document.getElementById('docLangContainer');
                                        const docLangCodeContainer = document.getElementById('docLangCodeContainer');

                                        const effectiveContainer = document.getElementById('effectiveContainer');
                                        const reviewContainer = document.getElementById('reviewContainer');
                                        const nextReviewContainer = document.getElementById('nextReviewContainer');

                                        const attachdraftContainer = document.getElementById('attachdraftContainer');
                                        const attacheffectContainer = document.getElementById('attacheffectContainer');


                                            // HODs field
                                        const hodsContainer = document.getElementById('hods-container');
                                        const hodsDropdown  = document.getElementById('hods-dropdown');
                                        const hodsError = document.getElementById('hodError');

                                        const reviewersLabel = document.getElementById('reviewers-label');
                                        
                                        if (selectedType === "SOP") {
                                            shortDescContainer.style.display = 'block';
                                            shortDescInput.setAttribute('required', 'required');
                                            shortDescInput.setAttribute('name', 'short_desc');
                                            shortDescRequired.style.display = 'inline';

                                            docNameContainer.style.display = 'block';
                                            docNameInput.setAttribute('required', 'required');
                                            docNameInput.setAttribute('name', 'document_name');
                                            docNameRequired.style.display = 'inline';

                                            sopTypeContainer.style.display = 'block';
                                            sopType.setAttribute('required', 'required');
                                            sopTypeRequired.style.display = 'inline';


                                            dueDateContainer.style.display = 'block';
                                            dueDateInput.setAttribute('required', 'required');
                                            dueDateRequired.style.display = 'inline';

                                            // departContainer.style.display = 'block';
                                            // departInput.setAttribute('required', 'required');
                                            // dueDateRequired.style.display = 'inline';

                                            docVerContainer.style.display = 'block';
                                            majorInput.setAttribute('required', 'required');

                                            notifyContainer.style.display = 'block';
                                            effectiveContainer.style.display = 'block';
                                            reviewContainer.style.display = 'block';
                                            nextReviewContainer.style.display = 'block';

                                            keywordContainer.style.display = 'block';
                                            docLangContainer.style.display = 'block';
                                            docLangCodeContainer.style.display = 'block';

                                            attachdraftContainer.style.display = 'block';
                                            attacheffectContainer.style.display = 'block';

                                            // Show HODs field
                                            hodsContainer.style.display = 'block';
                                            hodsDropdown.setAttribute('required', 'required');
                                            hodsError.style.display = 'none';

                                            reviewersLabel.innerHTML = "Reviewers<span class='text-danger'>*</span>";

                                            // Character counter for inputs
                                            $('#docname').off('keyup').on('keyup', function() {
                                                $('#rchars').text(maxLength - $(this).val().length);
                                            });

                                            $('#short_desc').off('keyup').on('keyup', function() {
                                                $('#new-rchars').text(maxLength - $(this).val().length);
                                            });

                                        } else {
                                            shortDescContainer.style.display = 'none';
                                            shortDescInput.removeAttribute('required');
                                            shortDescInput.value = '';

                                            docNameContainer.style.display = 'none';
                                            docNameInput.removeAttribute('required');
                                            docNameInput.value = '';

                                            sopTypeContainer.style.display = 'none';
                                            sopType.removeAttribute('required');
                                            sopType.value = '';

                                            dueDateContainer.style.display = 'none';
                                            dueDateInput.removeAttribute('required');
                                            dueDateInput.value = '';

                                            // departContainer.style.display = 'none';
                                            // departInput.removeAttribute('required');
                                            // departInput.value = '';

                                            docVerContainer.style.display = 'none';
                                            majorInput.removeAttribute('required');
                                            majorInput.value = '';

                                            notifyContainer.style.display = 'none';
                                            effectiveContainer.style.display = 'none';
                                            nextReviewContainer.style.display = 'none';
                                            reviewContainer.style.display = 'none';

                                            keywordContainer.style.display = 'none';
                                            docLangContainer.style.display = 'none';
                                            docLangCodeContainer.style.display = 'none';

                                            attachdraftContainer.style.display = 'none';
                                            attacheffectContainer.style.display = 'none';


                                            // Hide HODs field
                                            hodsContainer.style.display = 'none';
                                            hodsDropdown.removeAttribute('required');
                                            hodsDropdown.value = '';
                                            hodsError.style.display = 'none';

                                            reviewersLabel.innerHTML = "Checked By<span class='text-danger'>*</span>";
                                            
                                        }
                                    }


                                    function updateSopTypeShort() {
                                        const sopType = document.getElementById('sop_type').value;
                                        let shortName = '';
                                        if (sopType === 'SOP (Standard Operating procedure)') {
                                            shortName = 'SOP';
                                        } else if (sopType === 'EOP (Equipment Operating procedure)') {
                                            shortName = 'EOP';
                                        } else if (sopType === 'IOP (Instrument Operating Procedure)') {
                                            shortName = 'IOP';
                                        }
                                        document.getElementById('sop_type_short').value = shortName;
                                    }

                                    function validateForm() {
                                        let isValid = true;
                                        const shortDesc = document.getElementById('short_desc');
                                        const shortDescError = document.getElementById('short_descError');
                                        const docName = document.getElementById('docname');
                                        const docNameError = document.getElementById('docnameError');

                                        if (shortDesc.hasAttribute('required') && shortDesc.value.trim() === "") {
                                            shortDescError.style.display = 'inline';
                                            isValid = false;
                                        } else {
                                            shortDescError.style.display = 'none';
                                        }

                                        if (docName.hasAttribute('required') && docName.value.trim() === "") {
                                            docNameError.style.display = 'inline';
                                            isValid = false;
                                        } else {
                                            docNameError.style.display = 'none';
                                        }

                                        if (isValid) {
                                            alert("Form Submitted Successfully!");
                                        }
                                    }
                                </script>

                                <div class="col-md-6" id="attachdraftContainer" style="display: none">
                                    <div class="group-input">
                                        <label for="draft-doc">Attach Draft document</label>
                                        <input type="file" id="attach_draft_doc" name="attach_draft_doocument">
                                    </div>
                                </div>
                                <div class="col-md-6" id="attacheffectContainer" style="display: none">
                                    <div class="group-input">
                                        <label for="effective-doc">Attach Effective document</label>
                                        <input type="file" id="attach_effective_doc" name="attach_effective_docuement">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="orig-head">
                            Other Information
                        </div>
                        <div class="input-fields">
                            <div class="row">

                               <div class="col-md-6">
                                   <div class="group-input">
                                       <label for="reviewers" id="reviewers-label">Checked By<span class="text-danger">*</span></label>
                                       <select id="reviewers-dropdown"  class="form-control" name="reviewers[]" multiple required style="display: none">
                                           @if (!empty($reviewer))
                                               @foreach ($reviewer as $lan)
                                                   @if (Helpers::checkUserRolesreviewer($lan))
                                                       <option value="{{ $lan->id }}">{{ $lan->name }}</option>
                                                   @endif
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <p id="reviewerError" style="color:red; display: none;">** Reviewers are required</p>
                               </div>

                               <div class="col-md-6">
                                   <div class="group-input">
                                       <label for="approvers">Approvers<span class="text-danger">*</span></label>
                                       <select id="approvers-dropdown" class="form-control" name="approvers[]" multiple required style="display: none">
                                           @if (!empty($approvers))
                                               @foreach ($approvers as $lan)
                                                   @if (Helpers::checkUserRolesApprovers($lan))
                                                       <option value="{{ $lan->id }}">{{ $lan->name }}</option>
                                                   @endif
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                                   <p id="approverError" style="color:red; display: none;">** Approvers are required</p>
                               </div>

                               <div class="col-md-6" id="hods-container" style="display: none;">
                                   <div class="group-input">
                                       <label for="hods">HOD's<span class="text-danger">*</span></label>
                                       <select id="hods-dropdown" class="form-control" name="hods[]" multiple required style="display: none">
                                           @foreach ($hods as $hod)
                                               <option value="{{ $hod->id }}">{{ $hod->name }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <p id="hodError" style="color:red; display: none;">** HODs are required</p>
                               </div>

                            </div>
                            <div class="row">



                        {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="revision-type">Revision Type</label>
                                    <select name="revision_type">
                                        <option value="0">-- Select --</option>
                                        <option value="minor">Minor</option>
                                        <option value="major">Major</option>
                                        <option value="NA">NA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="summary">Revision Summary</label>
                                    <textarea name="revision_summary"></textarea>
                                </div>
                        </div> --}}

                        </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="nextButton" id="DocnextButton">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>


                    <!-- ---------------------------------------------------------------------------------------------------------------------------- -->
                    <!-- ---------------------------------------------------------------------------------------------------------------------------- -->

                    <div id="add-doc" class="tabcontent">
                        <div class="orig-head">
                            Training Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">Training Required?</label>
                                        <select name="training_required" required>
                                            <option value="">Enter your Selection</option>
                                            <option value="yes">Yes</option>
                                            <option value="no" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="link-doc">Trainer</label>
                                        <select name="trainer">
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach ($trainer as $temp)
                                                @if (Helpers::checkUserRolestrainer($temp))
                                                    <option value="{{ $temp->id }}">{{ $temp->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                <div class="group-input">
                                    <label for="launch-cbt">Launch CBT</label>
                                    <select name="cbt">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="training-type">Type</label>
                                    <select name="training-type">
                                        <option value="" selected>Enter your Selection</option>
                                        <option value="">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                        <option value="1`">Lorem, ipsum.</option>
                                    </select>
                                </div>
                            </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="test">
                                            Test(0)<button type="button" name="test"
                                                onclick="addTrainRow('test')">+</button>
                                        </label>
                                        <table class="table-bordered table" id="test">
                                            <thead>
                                                <tr>
                                                    <th class="row-num">Row No.</th>
                                                    <th class="question">Question</th>
                                                    <th class="answer">Answer</th>
                                                    <th class="result">Result</th>
                                                    <th class="comment">Comment</th>
                                                    <th class="comment">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="test">
                                            Survey(0)<button type="button" name="reporting1"
                                                onclick="addTrainRow('survey')">+</button>
                                        </label>
                                        <table class="table-bordered table" id="survey">
                                            <thead>
                                                <tr>
                                                    <th class="row-num">Row No.</th>
                                                    <th class="question">Subject</th>
                                                    <th class="answer">Topic</th>
                                                    <th class="result">Rating</th>
                                                    <th class="comment">Comment</th>
                                                    <th class="comment">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="comments">Comments</label>
                                        <textarea name="comments"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-content" class="tabcontent">
                        <div class="orig-head">
                            Document Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Objective</label>
                                        <textarea name="purpose"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="scope"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="responsibility" id="responsibility">
                                            Responsibility<button type="button" id="responsibilitybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="responsibilitydiv">
                                            <div class="singleResponsibilityBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="responsibility[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subResponsibilityAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="accountability" id="accountability">
                                            Accountability<button type="button" id="accountabilitybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="accountabilitydiv">
                                            <div class="singleAccountabilityBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="accountability[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAccountabilityAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="references" id="references">
                                            References<button type="button" id="referencesbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="referencesdiv">
                                            <div class="singleReferencesBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="references[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReferencesAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="abbreviation" id="abbreviation">
                                            Abbreviation<button type="button" id="abbreviationbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="abbreviationdiv">
                                            <div class="singleAbbreviationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="abbreviation[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAbbreviationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="abbreviation" id="definition">
                                            Definition<button type="button" id="Definitionbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="definitiondiv">

                                            <div class="singleDefinitionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="defination[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subDefinitionAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            General Instructions<button type="button" id="materialsbtadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div class="materialsBlock">
                                            <div class="singleMaterialBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="materials_and_equipments[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subMaterialsAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Procedure</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="procedure" class="summernote">
                                    </textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12 mb-3">
                                                            <div class="group-input">
                                                                <label for="procedure" id="newreport">
                                                                Procedure<button type="button" id="reportingbtadd" name="button">+</button>
                                                                </label>
                                                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>

                                                                <div id="reportingdiv">
                                                                    <div class="singleReportingBlock">
                                                                        <div class="row">
                                                                            <div class="col-sm-10">
                                                                                <textarea name="procedure[]" class=""></textarea>
                                                                            </div>
                                                                            <div class="col-sm-1">
                                                                                <button class="btn btn-dark subReportingAdd">+</button>
                                                                            </div>
                                                                            <div class="col-sm-1">
                                                                                <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div> -->



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Cross References<button type="button" id="reportingbtadd"
                                                name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="reportingdiv">
                                            <div class="singleReportingBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="reporting[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReportingAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ann" id="ann">
                                            Annexure<button type="button" id="annbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="anndiv">
                                            <div class="singleAnnexureBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ann[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAnnexureAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row reference-data">
                                            <div class="col-lg-6">
                                                <input type="text" name="reference-text">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="file" name="references" class="myclassname">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">  ---By Aditya
                                    <div class="group-input">
                                        <label for="annexure">
                                            Annexure<button type="button" name="ann" id="annexurebtnadd">+</button>
                                        </label>
                                        <table class="table-bordered table" id="annexure">
                                            <div><small class="text-primary">Please mention brief summary</small></div>
                                            <thead>
                                                <tr>
                                                    <th class="sr-num">Sr. No.</th>
                                                    <th class="annx-num">Annexure No.</th>
                                                    <th class="annx-title">Title of Annexure</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="serial_number[]" value="1"></td>
                                                    <td><input type="text" name="annexure_number[]"></td>
                                                    <td><input type="text" name="annexure_data[]"></td>
                                                </tr>
                                                <div id="annexurediv"></div>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}

                                <!-- add revision history -->
                                {{-- <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="summary">Revision History</label>
                                        <textarea name="revision_summary"></textarea>
                                    </div>
                                </div> --}}

                                <div class="input-fields">
                                    <div class="group-input">
                                        <label for="distribution-list" style="font-weight: bold;">
                                            Distribution List
                                        </label>
                                        <div class="table-responsive retrieve-table">
                                            <table class="table table-bordered" id="distribution-list">
                                                <thead>
                                                    <tr>
                                                        <th>Row</th>
                                                        <th class="copy-name">Copy</th>
                                                        <th class="copy-name">No. of Copies</th>
                                                        <th class="copy-name">User Department</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td style="font-weight: bold;">Master Copy</td>
                                                        <td><input type="text" id="copies-master"
                                                                name="master_copy_number" value=""
                                                                class="form-control">
                                                        </td>

                                                        <td>
                                                            <div class="col-md-6">
                                                                <div class="group-input">
                                                                    <input type="text" name="master_user_department">
                                                                    {{-- <select name="master_user_department"
                                                                        class="form-control" id="master_user_department">
                                                                        <option value="" selected>Select the
                                                                            departments</option>
                                                                        @foreach (Helpers::getDepartments() as $code => $department)
                                                                            <option value="{{ $code }}">
                                                                                {{ $department }}</option>
                                                                        @endforeach
                                                                    </select> --}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td style="font-weight: bold;">Controlled Copy</td>
                                                        <td><input type="text" id="copies-controlled"
                                                                name="controlled_copy_number" value=""
                                                                class="form-control"></td>

                                                        <td>
                                                            <div class="col-md-6">
                                                                <div class="group-input">
                                                                <input type="text" name="controlled_user_department">

                                                                    {{-- <select name="controlled_user_department"
                                                                        class="form-control"
                                                                        id="controlled_user_department">
                                                                        <option value="" selected>Select the
                                                                            departments</option>
                                                                        @foreach (Helpers::getDepartments() as $code => $department)
                                                                            <option value="{{ $code }}">
                                                                                {{ $department }}</option>
                                                                        @endforeach
                                                                    </select> --}}
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td style="font-weight: bold;">Display Copy</td>
                                                        <td><input type="text" id="copies-display"
                                                                name="display_copy_number" value=""
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <div class="col-md-6">
                                                                <div class="group-input">
                                                                    <input type="text" name="display_user_department">
                                                                    {{-- <select name="display_user_department"
                                                                        class="form-control" id="display_user_department">
                                                                        <option value="" selected>Select the
                                                                            departments</option>
                                                                        @foreach (Helpers::getDepartments() as $code => $department)
                                                                            <option value="{{ $code }}">
                                                                                {{ $department }}</option>
                                                                        @endforeach
                                                                    </select> --}}
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="test">
                                            Revision History
                                        </label>
                                        <div><small class="text-primary"></small></div>
                                        <div class="table-responsive retrieve-table">
                                        <table class="table-bordered table" id="">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th class="copy-name">Revision No.</th>
                                                    <th class="copy-name">Change Control No.</th>
                                                    <th class="copy-name">Effective Date</th>
                                                    <th class="copy-name">Reason of revision</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><input type="text" id="" name="revision_number" value="" class="form-control"></td>
                                                    <td><input type="text" id="" name="cc_no" value="" class="form-control"></td>
                                                    <td><input type="date" id="" name="revised_effective_date" value="" class="form-control"></td>
                                                    <td><input type="text" id="" name="reason_of_revision" value="" class="form-control"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

    <!-----------------MASTER FINISHED PRODUCT SPECIFICATION Tab ---------------------->
                    <div id="doc-mfps" class="tabcontent">
                        <div class="orig-head">
                            Master Finished Product Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Specification No<span class="text-danger">*</span></label>
                                        <input type="text" id="specification" name="specification_mfps_no" maxlength="255">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">STP No<span class="text-danger">*</span></label>
                                        <input type="text" id="stp" name="stp_mfps_no" maxlength="255">
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Name of Product</label>
                                        <input type="text" id="mfproduct" name="mfproduct_name" maxlength="255">
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- <div class="input-fields">
                            <div class="group-input">
                                <label for="specifications">
                                    Specifications
                                    <button type="button" onclick="addSpecifications()">+</button>
                                </label>
                                <div class="table-responsive retrieve-table">
                                    <table class="table table-bordered" id="specifications-grid">
                                        <thead>
                                            <tr>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Sr. No.</th>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Tests</th>
                                                <th  colspan="2" style="font-size: 16px; font-weight: bold;">Specifications</th>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Reference</th>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Action</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 16px; font-weight: bold;">Release</th>
                                                <th style="font-size: 16px; font-weight: bold;">Shelf life</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($specifications ?? [] as $index => $spec)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><input type="text" name="specifications[{{ $index }}][tests]" value="{{ $spec->tests }}"></td>
                                                <td><input type="text" name="specifications[{{ $index }}][release]" value="{{ $spec->release }}"></td>
                                                <td><input type="text" name="specifications[{{ $index }}][shelf_life]" value="{{ $spec->shelf_life }}"></td>
                                                <td><input type="text" name="specifications[{{ $index }}][reference]" value="{{ $spec->reference }}"></td>
                                                <td><button type="button" class="removeSpecRow">Remove</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-12 sub-head">
                            SPECIFICATION
                            <div class="group-input">
                                <label for="procedure"></label>
                                <textarea name="master_specification" class="summernote"></textarea>
                            </div>
                        </div>

                        




                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>




                    <!-- temp kp -->

                    {{-- temperature mapping protcal tabs  --}}

                <div id="doc-tempmapping" class="tabcontent">
                    <div class="orig-head">
                        Temperature Mapping Protocol Cum Report
                    </div>
                    <div class="input-fields">
                        <div class="row">

                        {{--
                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ProtocolApproval_TemperMap" id="ProtocolApproval_TemperMap">
                                        ProtocolApproval TemperMap<button type="button" id="ProtocolApproval_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ProtocolApproval_TemperMapdiv">
                                        <div class="singleProtocolApproval_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ProtocolApproval_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subProtocolApproval_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Objective_TemperMap" id="Objective_TemperMap">
                                        Objective<button type="button" id="Objective_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Objective_TemperMapdiv">
                                        <div class="singleObjective_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Objective_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subObjective_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Scope_TemperMap" id="Scope_TemperMap">
                                        Scope<button type="button" id="Scope_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Scope_TemperMapdiv">
                                        <div class="singleScope_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Scope_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subScope_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="AreaValidated_TemperMap" id="AreaValidated_TemperMap">
                                        Area to be Validated<button type="button" id="AreaValidated_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="AreaValidated_TemperMapdiv">
                                        <div class="singleAreaValidated_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="AreaValidated_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAreaValidated_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ValidationTeamResponsibilities_TemperMap" id="ValidationTeamResponsibilities_TemperMap">
                                        Validation team & its Responsibilities<button type="button" id="ValidationTeamResponsibilities_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ValidationTeamResponsibilities_TemperMapdiv">
                                        <div class="singleValidationTeamResponsibilities_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ValidationTeamResponsibilities_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subValidationTeamResponsibilities_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Reference_TemperMap" id="Reference_TemperMap">
                                        Reference<button type="button" id="Reference_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Reference_TemperMapdiv">
                                        <div class="singleReference_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Reference_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subReference_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="DocumentFollowed_TemperMap" id="DocumentFollowed_TemperMap">
                                        Document to be Followed<button type="button" id="DocumentFollowed_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="DocumentFollowed_TemperMapdiv">
                                        <div class="singleDocumentFollowed_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="DocumentFollowed_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subDocumentFollowed_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="StudyRationale_TemperMap" id="StudyRationale_TemperMap">
                                        Study Rationale<button type="button" id="StudyRationale_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="StudyRationale_TemperMapdiv">
                                        <div class="singleStudyRationale_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="StudyRationale_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subStudyRationale_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Procedure_TemperMap" id="Procedure_TemperMap">
                                        Procedure<button type="button" id="Procedure_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Procedure_TemperMapdiv">
                                        <div class="singleProcedure_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Procedure_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subProcedure_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="CriteriaRevalidation_TemperMap" id="CriteriaRevalidation_TemperMap">
                                        Criteria for Revalidation<button type="button" id="CriteriaRevalidation_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="CriteriaRevalidation_TemperMapdiv">
                                        <div class="singleCriteriaRevalidation_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="CriteriaRevalidation_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subCriteriaRevalidation_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="MaterialDocumentRequired_TemperMap" id="MaterialDocumentRequired_TemperMap">
                                        Material and Document Required<button type="button" id="MaterialDocumentRequired_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="MaterialDocumentRequired_TemperMapdiv">
                                        <div class="singleMaterialDocumentRequired_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="MaterialDocumentRequired_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subMaterialDocumentRequired_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="AcceptanceCriteria_TemperMap" id="AcceptanceCriteria_TemperMap">
                                        Acceptance Criteria<button type="button" id="AcceptanceCriteria_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="AcceptanceCriteria_TemperMapdiv">
                                        <div class="singleAcceptanceCriteria_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="AcceptanceCriteria_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAcceptanceCriteria_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="TypeofValidation_TemperMap" id="TypeofValidation_TemperMap">
                                        Type of Validation<button type="button" id="TypeofValidation_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="TypeofValidation_TemperMapdiv">
                                        <div class="singleTypeofValidation_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="TypeofValidation_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subTypeofValidation_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ObservationResult_TemperMap" id="ObservationResult_TemperMap">
                                        Observation and Result<button type="button" id="ObservationResult_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ObservationResult_TemperMapdiv">
                                        <div class="singleObservationResult_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ObservationResult_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subObservationResult_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Abbreviations_TemperMap" id="Abbreviations_TemperMap">
                                        Abbreviations<button type="button" id="Abbreviations_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Abbreviations_TemperMapdiv">
                                        <div class="singleAbbreviations_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Abbreviations_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAbbreviations_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="DeviationAny_TemperMap" id="DeviationAny_TemperMap">
                                        Deviation if Any<button type="button" id="DeviationAny_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="DeviationAny_TemperMapdiv">
                                        <div class="singleDeviationAny_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="DeviationAny_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subDeviationAny_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ChangeControl_TemperMap" id="ChangeControl_TemperMap">
                                        Change Control <button type="button" id="ChangeControl_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ChangeControl_TemperMapdiv">
                                        <div class="singleChangeControl_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ChangeControl_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subChangeControl_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Summary_TemperMap" id="Summary_TemperMap">
                                        Summary <button type="button" id="Summary_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Summary_TemperMapdiv">
                                        <div class="singleSummary_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Summary_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subSummary_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Conclusion_TemperMap" id="Conclusion_TemperMap">
                                        Conclusion <button type="button" id="Conclusion_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Conclusion_TemperMapdiv">
                                        <div class="singleConclusion_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Conclusion_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subConclusion_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="AttachmentList_TemperMap" id="AttachmentList_TemperMap">
                                        Attachment List <button type="button" id="AttachmentList_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="AttachmentList_TemperMapdiv">
                                        <div class="singleAttachmentList_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="AttachmentList_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAttachmentList_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="PostApproval_TemperMap" id="PostApproval_TemperMap">
                                        Post Approval <button type="button" id="PostApproval_TemperMapbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="PostApproval_TemperMapdiv">
                                        <div class="singlePostApproval_TemperMapBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="PostApproval_TemperMap[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subPostApproval_TemperMapAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        --}}


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Temperature Mapping Protocol Cum Report Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="TemMapProCumRep_fileattachement"></div>

                                        <div class="add-btn">
                                            <label for="TemMapProCumRep_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                            <input type="file" id="TemMapProCumRep_I_gxp_attachment" name="TemMapProCumRepfile_attach[]"
                                                oninput="addMultipleFiles(this, 'TemMapProCumRep_fileattachement')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = "";

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>

                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>

            <!-----------------MASTER FINISHED PRODUCT STANDARD TESTING PROCEDURE Tab ---------------------->

                    <div id="doc-mfpstp" class="tabcontent">
                        <div class="orig-head">
                             Master Finished Product Standard Testing Procedure
                        </div>
                        <div class="input-fields">
                            <div class="row">
                               {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">STP No</label>
                                        <input type="text" id="stp" name="stp_mfpstp_no" maxlength="255" >
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Product Name</label>
                                        <input type="text" name="product_name_mstp">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Specification No</label>
                                        <input type="text" id="specification" name="specification_mfpstp_no" maxlength="255">
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                    Standard Testing procedure
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="mfpstp_specification" class="summernote"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            function addSpecificationsTesting() {
                                let table = document.getElementById("specifications-testing").getElementsByTagName('tbody')[0];
                                let rowCount = table.rows.length;
                                let newRow = table.insertRow();

                                newRow.innerHTML = `
                                    <td>${rowCount + 1}</td>
                                    <td><input type="text" name="specifications_testing[${rowCount}][tests]"></td>
                                    <td><button type="button" class="removeSpecRow">Remove</button></td>
                                `;
                            }

                            // Event delegation for removing rows
                            document.addEventListener("click", function (event) {
                                if (event.target.classList.contains("removeSpecRow")) {
                                    let row = event.target.closest("tr");
                                    row.remove();
                                    updateSerialNumbers();
                                }
                            });

                            function updateSerialNumbers() {
                                let rows = document.querySelectorAll("#specifications-testing tbody tr");
                                rows.forEach((row, index) => {
                                    row.cells[0].textContent = index + 1;
                                    row.querySelectorAll("input").forEach(input => {
                                        let nameParts = input.name.match(/specifications_testing\[\d+]\[(.+)]/);
                                        if (nameParts) {
                                            input.name = `specifications_testing[${index}][${nameParts[1]}]`;
                                        }
                                    });
                                });
                            }

                            window.addSpecificationsTesting = addSpecificationsTesting;
                        });
                    </script>

    <!-----------------STUDY REPORT Tab ---------------------->
                    <div id="doc-study" class="tabcontent">
                        <div class="orig-head">
                            Study Report
                        </div>
                        {{--
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Objective</label>
                                        <textarea name="study_purpose"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="study_scope"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="responsibilities" id="responsibilities">
                                            Responsibilities<button type="button" id="responsibilitiesbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="responsibilitiesdiv">
                                            <div class="singleResponsibilitiesBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="responsibilities[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subResponsibilitiesAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="referencesss" id="referencesss">
                                            References(if any)<button type="button" id="referencesssbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="referencesssdiv">
                                            <div class="singleReferencesssBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="referencesss[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReferencesssAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="assessment" id="assessment">
                                            Assessment & Evaluation<button type="button" id="assessmentbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="assessmentdiv">
                                            <div class="singleAssessmentBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="assessment[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAssessmentAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="strategy" id="strategy">
                                            Strategy of Evaluation <button type="button" id="Strategybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="strategydiv">

                                            <div class="singleStrategyBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="strategy[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subStrategyAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="summary" id="summary">
                                            Summary & Findings<button type="button" id="newSummarybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="summarydiv">
                                            <div class="singleSummaryBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="summary_and_findings[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subSummaryAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Procedure</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="procedure" class="summernote">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Cross References<button type="button" id="reportingbtadd"
                                                name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="reportingdiv">
                                            <div class="singleReportingBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="reporting[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReportingAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ann" id="ann">
                                            Annexure<button type="button" id="annbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="anndiv">
                                            <div class="singleAnnexureBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ann[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAnnexureAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        --}}
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>File Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachment_srt"></div>

                                        <div class="add-btn">
                                            <label for="attachment_srtData" style="cursor: pointer;">Add</label>
                                            <input type="file" id="attachment_srtData" name="attachment_srt[]"
                                                oninput="addMultipleFiles(this, 'attachment_srt')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>


                    <!-----------------Study Protocol Tab ---------------------->
                    <div id="doc-stprotocol" class="tabcontent">
                        <div class="orig-head">
                            Study Protocol
                        </div>
                        {{--
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Objective</label>
                                        <textarea name="stprotocol_purpose"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="stprotocol_scope"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="stresponsibility" id="stresponsibility">
                                            Responsibilities<button type="button" id="stresponsibilitybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="stresponsibilitydiv">
                                            <div class="singleStResponsibilityBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stresponsibility[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substResponsibilityAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="stdefination" id="stdefination">
                                            Defination<button type="button" id="stdefinationbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="stdefinationdiv">
                                            <div class="singlestdefinationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stdefination[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substdefinationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="streferences" id="streferences">
                                            References(if any)<button type="button" id="streferencesbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="streferencesdiv">
                                            <div class="singlestreferencesBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="streferences[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substreferencesAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="stbackground" id="stbackground">
                                            Background/History(if any)<button type="button" id="stbackgroundbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="stbackgrounddiv">
                                            <div class="singlestbackgroundBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stbackground[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substbackgroundAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="stassessment" id="stassessment">
                                            Assessment/Evaluation<button type="button" id="stassessmentbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="stassessmentdiv">

                                            <div class="singlestassessmentBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stassessment[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substassessmentAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ststrategy" id="ststrategy">
                                            Strategy Methodology<button type="button" id="ststrategybtadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="ststrategyBlock">
                                            <div class="singleststrategyBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ststrategy[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-dark subststrategyAdd" >+</button>

                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="stsummary" id="stsummary">
                                            Summary & Findings<button type="button" id="stsummarybtadd"
                                                name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="stsummarydiv">
                                            <div class="singlestsummaryBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stsummary[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substsummaryAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="stconclusion" id="stconclusion">
                                           Conclusion<button type="button" id="stconclusionbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="stconclusiondiv">
                                            <div class="singlestconclusionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stconclusion[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substconclusionAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="stannexure" id="stannexure">
                                            Annexure<button type="button" id="stannexurebtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="stannexurediv">
                                            <div class="singlestannexureBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stannexure[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substannexureAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Doc_No" id="Doc_No">
                                            Reference Document Number (if any)<button type="button" id="Referencedocunumadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="Referencedocunumdiv">
                                            <div class="singleReferencedocunumBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Referencedocunum[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substReferencedocunumAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        --}}
                                     <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachment_spt"></div>

                                                <div class="add-btn">
                                                    <label for="attachment_sptData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="attachment_sptData" name="attachment_spt[]"
                                                        oninput="addMultipleFiles(this, 'attachment_spt')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>


    <!-----------------MASTER FINISHED PRODUCT SPECIFICATION Tab ---------------------->
                    {{-- <div id="doc-mfps" class="tabcontent">
                        <div class="orig-head">
                            Master Finished Product Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Specification No<span class="text-danger">*</span></label>
                                        <input type="text" id="specification" name="specification_mfps_no" maxlength="255">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">STP No<span class="text-danger">*</span></label>
                                        <input type="text" id="stp" name="stp_mfps_no" maxlength="255">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="input-fields">
                            <div class="group-input">
                                <label for="specifications">
                                    Specifications
                                    <button type="button" onclick="addSpecifications()">+</button>
                                </label>
                                <div class="table-responsive retrieve-table">
                                    <table class="table table-bordered" id="specifications-grid">
                                        <thead>
                                            <tr>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Sr. No.</th>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Tests</th>
                                                <th  colspan="2" style="font-size: 16px; font-weight: bold;">Specifications</th>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Reference</th>
                                                <th  rowspan="2" style="font-size: 16px; font-weight: bold;">Action</th>
                                            </tr>
                                            <tr>
                                                <th style="font-size: 16px; font-weight: bold;">Release</th>
                                                <th style="font-size: 16px; font-weight: bold;">Shelf life</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($specifications ?? [] as $index => $spec)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><input type="text" name="specifications[{{ $index }}][tests]" value="{{ $spec->tests }}"></td>
                                                <td><input type="text" name="specifications[{{ $index }}][release]" value="{{ $spec->release }}"></td>
                                                <td><input type="text" name="specifications[{{ $index }}][shelf_life]" value="{{ $spec->shelf_life }}"></td>
                                                <td><input type="text" name="specifications[{{ $index }}][reference]" value="{{ $spec->reference }}"></td>
                                                <td><button type="button" class="removeSpecRow">Remove</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div> --}}

               <!-----------------MASTER FINISHED PRODUCT STANDARD TESTING PROCEDURE Tab ---------------------->

                    {{-- <div id="doc-mfpstp" class="tabcontent">
                        <div class="orig-head">
                             Master Finished Product Standard Testing Procedure
                        </div>
                        <div class="input-fields">
                            <div class="row">
                               <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">STP No<span class="text-danger">*</span></label>
                                        <input type="text" id="stp" name="stp_mfpstp_no" maxlength="255" >
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Specification No<span class="text-danger">*</span></label>
                                        <input type="text" id="specification" name="specification_mfpstp_no" maxlength="255">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="input-fields">
                            <div class="group-input">
                                <label for="specifications">
                                     Specifications Testing
                                    <button type="button" onclick="addSpecificationsTesting()">+</button>
                                </label>
                                <div class="table-responsive retrieve-table">
                                    <table class="table table-bordered" id="specifications-testing">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th class="copy-name">Tests</th>
                                                <th class="copy-name">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($specifications ?? [] as $index => $spec)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><input type="text" name="specifications_testing[{{ $index }}][tests]" value="{{ $spec->tests }}"></td>
                                                <td><button type="button" class="removeSpecRow">Remove</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            function addSpecificationsTesting() {
                                let table = document.getElementById("specifications-testing").getElementsByTagName('tbody')[0];
                                let rowCount = table.rows.length;
                                let newRow = table.insertRow();

                                newRow.innerHTML = `
                                    <td>${rowCount + 1}</td>
                                    <td><input type="text" name="specifications_testing[${rowCount}][tests]"></td>
                                    <td><button type="button" class="removeSpecRow">Remove</button></td>
                                `;
                            }

                            // Event delegation for removing rows
                            document.addEventListener("click", function (event) {
                                if (event.target.classList.contains("removeSpecRow")) {
                                    let row = event.target.closest("tr");
                                    row.remove();
                                    updateSerialNumbers();
                                }
                            });

                            function updateSerialNumbers() {
                                let rows = document.querySelectorAll("#specifications-testing tbody tr");
                                rows.forEach((row, index) => {
                                    row.cells[0].textContent = index + 1;
                                    row.querySelectorAll("input").forEach(input => {
                                        let nameParts = input.name.match(/specifications_testing\[\d+]\[(.+)]/);
                                        if (nameParts) {
                                            input.name = `specifications_testing[${index}][${nameParts[1]}]`;
                                        }
                                    });
                                });
                            }

                            window.addSpecificationsTesting = addSpecificationsTesting;
                        });
                    </script> --}}

                    <!-- equipment report -->

                    <div id="doc-eqpreport" class="tabcontent">
                        <div class="orig-head">
                          Equipment Hold Time Study Report
                        </div>
                        {{--
                        <div class="input-fields">
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="objective">Report No.</label>
                                        <textarea name="equipment_report"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="objective">Batch No.</label>
                                        <textarea name="equipment_batch"></textarea>
                                    </div>
                                </div> -->
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="objective">Objective</label>
                                        <textarea name="equipment_objective"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="equipment_scope"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Purpose</label>
                                        <textarea name="equipment_purpose"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="euipmentresponsibility" id="euipmentresponsibility">
                                            Responsibilities<button type="button" id="euipmentresponsibilitybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="euipmentresponsibilitydiv">
                                            <div class="singleEuipmentResponsibilityBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="euipmentresponsibility[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEuipmentResponsibilityAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="AnalyticalReport" id="AnalyticalReport">
                                            Analytical Report<button type="button" id="eqpAnalyticalReportbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="eqpAnalyticalReportdiv">
                                            <div class="singleEqpAnalyticalReportBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpAnalyticalReport[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpAnalyticalReportAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpdeviation" id="eqpdeviation">
                                            Deviation (If Any)<button type="button" id="eqpdeviationbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="eqpdeviationdiv">
                                            <div class="singleEqpdeviationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdeviation[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpdeviationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpchangecontrol" id="eqpchangecontrol">
                                            Change Control ( If Any)<button type="button" id="eqpchangecontrolbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="eqpchangecontroldiv">
                                            <div class="singleEqpchangecontrolBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpchangecontrol[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpchangecontrolAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpsummary" id="eqpsummary">
                                            Summary<button type="button" id="eqpsummarybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="eqpsummarydiv">

                                            <div class="singleEqpsummaryBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpsummary[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpsummaryAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpconclusion" id="eqpconclusion">
                                            Conclusion<button type="button" id="eqpconclusionbtadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="eqpconclusiondiv">
                                            <div class="singleEqpconclusionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpconclusion[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-dark subeqpconclusionAdd" >+</button>

                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpreportapproval" id="eqpreportapproval">
                                            Report Approval<button type="button" id="eqpreportapprovalbtadd"
                                                name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="eqpreportapprovaldiv">
                                            <div class="singleEqpreportapprovalBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpreportapproval[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subeqpreportapprovalAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        --}}
                                  <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachment_ehtsr"></div>

                                                <div class="add-btn">
                                                    <label for="attachment_ehtsrData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="attachment_ehtsrData" name="attachment_ehtsr[]"
                                                        oninput="addMultipleFiles(this, 'attachment_ehtsr')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>


                    {{-- Packing validation report by kpatel --}}

                    <div id="doc-PacValRep" class="tabcontent">
                        <div class="orig-head">
                            Packing Vaidation Report
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            {{--
                            <div class="col-md-6">
                                <div class="group-input">
                                        <label for="purpose">Generic Name </label>
                                        <input type="text" name="generic_PacValRep">
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Product Code</label>
                                        <input type="text" name="PacValRep_product_code">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Std. Batch size </label>
                                        <input type="text" name="PacValRep_std_batch">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Category</label>
                                        <input type="text" name="PacValRep_category">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Label Claim  </label>
                                        <input type="text" name="PacValRep_label_claim">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Market</label>
                                        <input type="text" name="PacValRep_market">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Shelf Life</label>
                                        <input type="text" name="PacValRep_shelf_life">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">BPR No.</label>
                                        <input type="text" name="PacValRep_bmr_no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">MPR No.</label>
                                        <input type="text" name="PacValRep_mpr_no">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Purpose_HoTiStRe" id="Purpose_PaVaReKp">
                                            Purpose<button type="button" id="Purpose_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div> </label>
                                        <div id="Purpose_PaVaReKpdiv">
                                            <div class="singlePurpose_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Purpose_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subPurpose_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Scope_PaVaReKp" id="Scope_PaVaReKp">
                                            Scope<button type="button" id="Scope_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="Scope_PaVaReKpdiv">
                                            <div class="singleScope_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Scope_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subScope_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="BatchDetails_PaVaReKp" id="BatchDetails_PaVaReKp">
                                            Batch Details<button type="button" id="BatchDetails_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label><div id="BatchDetails_PaVaReKpdiv">
                                            <div class="singleBatchDetails_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="BatchDetails_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subBatchDetails_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ReferenceDocument_PaVaReKp" id="ReferenceDocument_PaVaReKp">
                                            Reference Document<button type="button" id="ReferenceDocument_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="ReferenceDocument_PaVaReKpdiv">
                                            <div class="singleReferenceDocument_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ReferenceDocument_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReferenceDocument_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="PackingMaterialApprovalVendDeat_PaVaReKp" id="PackingMaterialApprovalVendDeat_PaVaReKp">
                                            Packing Material Approved Vendor Details<button type="button" id="PackingMaterialApprovalVendDeat_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="PackingMaterialApprovalVendDeat_PaVaReKpdiv">
                                            <div class="singlePackingMaterialApprovalVendDeat_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="PackingMaterialApprovalVendDeat_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subPackingMaterialApprovalVendDeat_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="UsedEquipmentCalibrationQualiSta_PaVaReKp" id="UsedEquipmentCalibrationQualiSta_PaVaReKp">
                                            Used Equipment Calibration and  Qualification status<button type="button" id="UsedEquipmentCalibrationQualiSta_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="UsedEquipmentCalibrationQualiSta_PaVaReKpdiv">
                                            <div class="singleUsedEquipmentCalibrationQualiSta_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="UsedEquipmentCalibrationQualiSta_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subUsedEquipmentCalibrationQualiSta_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ResultOfPacking_PaVaReKp" id="ResultOfPacking_PaVaReKp">
                                            Results Of Packing (Finished product)<button type="button" id="ResultOfPacking_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="ResultOfPacking_PaVaReKpdiv">
                                            <div class="singleResultOfPacking_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ResultOfPacking_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subResultOfPacking_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="CriticalProcessParameters_PaVaReKp" id="CriticalProcessParameters_PaVaReKp">
                                            Critical process parameters & Critical quality attributes<button type="button" id="CriticalProcessParameters_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="CriticalProcessParameters_PaVaReKpdiv">
                                            <div class="singleCriticalProcessParameters_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="CriticalProcessParameters_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subCriticalProcessParameters_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="yield_PaVaReKp" id="yield_PaVaReKp">
                                            % Yield<button type="button" id="yield_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="yield_PaVaReKpdiv">
                                            <div class="singleyield_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="yield_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subyield_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="HoldTimeStudy_PaVaReKp" id="HoldTimeStudy_PaVaReKp">
                                            Hold time Study<button type="button" id="HoldTimeStudy_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="HoldTimeStudy_PaVaReKpdiv">
                                            <div class="singleHoldTimeStudy_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="HoldTimeStudy_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subHoldTimeStudy_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="CleaningValidation_PaVaReKp" id="CleaningValidation_PaVaReKp">
                                            Cleaning validation<button type="button" id="CleaningValidation_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="CleaningValidation_PaVaReKpdiv">
                                            <div class="singleCleaningValidation_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="CleaningValidation_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subCleaningValidation_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="StabilityStudy_PaVaReKp" id="StabilityStudy_PaVaReKp">
                                            Stability study<button type="button" id="StabilityStudy_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div></label>
                                        <div id="StabilityStudy_PaVaReKpdiv">
                                            <div class="singleStabilityStudy_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="StabilityStudy_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subStabilityStudy_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="DeviationIfAny_PaVaReKp" id="DeviationIfAny_PaVaReKp">
                                            Deviation If Any <button type="button" id="DeviationIfAny_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="DeviationIfAny_PaVaReKpdiv">
                                            <div class="singleDeviationIfAny_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="DeviationIfAny_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subDeviationIfAny_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input"> <label for="ChangeControlifany_PaVaReKp" id="ChangeControlifany_PaVaReKp">
                                            Change Control ( If any) <button type="button" id="ChangeControlifany_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div> </label>
                                        <div id="ChangeControlifany_PaVaReKpdiv">
                                            <div class="singleChangeControlifany_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ChangeControlifany_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subChangeControlifany_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Summary_PaVaReKp" id="Summary_PaVaReKp">
                                            Summary<button type="button" id="Summary_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div> </label>
                                            <div id="Summary_PaVaReKpdiv">
                                            <div class="singleSummary_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Summary_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subSummary_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Conclusion_PaVaReKp" id="Conclusion_PaVaReKp">
                                            Conclusion <button type="button" id="Conclusion_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="Conclusion_PaVaReKpdiv">
                                            <div class="singleConclusion_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Conclusion_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subConclusion_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="ProposedParameters_PaVaReKp" id="ProposedParameters_PaVaReKp">
                                            Proposed Parameters for Upcoming Batches <button type="button" id="ProposedParameters_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="ProposedParameters_PaVaReKpdiv">
                                            <div class="singleProposedParameters_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ProposedParameters_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subProposedParameters_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                    <label for="ReportApproval_PaVaReKp" id="ReportApproval_PaVaReKp">
                                            Report Approval <button type="button" id="ReportApproval_PaVaReKpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="ReportApproval_PaVaReKpdiv">
                                            <div class="singleReportApproval_PaVaReKpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="ReportApproval_PaVaReKp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReportApproval_PaVaReKpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                    --}}

                    <div class="col-12">
                        <div class="group-input">
                            <label for="File_Attachment"><b>Packing validation Report Attachment</b></label>
                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="PacValRepfile_attach"></div>

                                <div class="add-btn">
                                    <label for="annex_I_gxp_attachmentPacValRepfile_attach" style="cursor: pointer;">Add</label>
                                    <input type="file" id="annex_I_gxp_attachmentPacValRepfile_attach" name="PacValRepfile_attach[]"
                                        oninput="addMultipleFiles(this, 'PacValRepfile_attach')" multiple hidden>
                                </div>
                            </div>
                        </div>
                    </div>



                    <script>
                    function addMultipleFiles(input, listId) {
                        let fileList = document.getElementById(listId);
                        fileList.innerHTML = ""; // Clear previous files (if needed)

                        for (let file of input.files) {
                            let fileItem = document.createElement("div");
                            fileItem.textContent = file.name;
                            fileList.appendChild(fileItem);
                        }
                    }
                    </script>




                    </div>
                </div>
                <div class="button-block">
                    <button type="submit" value="save" name="submit" id="DocsaveButton"
                        class="saveButton">Save</button>
                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                        </a>
                    </button>
                </div>
            </div>



            <!-- Equipment Hold Time Study Protocol -->

                    <div id="doc-eqpprotocol" class="tabcontent">
                        <div class="orig-head">
                          Equipment Hold Time Study Protocol
                        </div>


                        {{--
                        <div class="input-fields">
                            <div class="row">




                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Approval</label>
                                        <textarea name="eqp_approval"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="objective">Objective</label>
                                        <textarea name="eqp_objective"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="eqp_scope"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="eqpresponsibility" id="eqpresponsibility">
                                            Responsibility<button type="button" id="eqpresponsibilitybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="eqpresponsibilitydiv">
                                            <div class="singleEqpresponsibilityBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpresponsibility[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpResponsibilityAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="eqpdetails" id="eqpdetails">
                                            Equipment & Product details<button type="button" id="eqpdetailsbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="eqpdetailsdiv">
                                            <div class="singleEqpDetailsBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdetails[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpDetailsAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="eqpsampling" id="eqpsampling">
                                            Sampling plan<button type="button" id="eqpsamplingbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="eqpsamplingdiv">
                                            <div class="singleEqpSamplingBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpsampling[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpSamplingAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Samplingprocedure" id="Samplingprocedure">
                                           Sampling and analysis procedure<button type="button" id="Samplingprocedurebtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="Samplingprocedurediv">
                                            <div class="singleSamplingprocedureBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Samplingprocedure[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subSamplingprocedureAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="AcceptenceCriteria" id="AcceptenceCriteria">
                                           Acceptance Criteria<button type="button" id="AcceptenceCriteriabtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="AcceptenceCriteriadiv">
                                            <div class="singleAcceptenceCriteriaBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="AcceptenceCriteria[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAcceptenceCriteriaAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="EnvironmentalConditions" id="EnvironmentalConditions">
                                            Environmental Conditions<button type="button" id="EnvironmentalConditionsbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="EnvironmentalConditionsdiv">
                                            <div class="singleEnvironmentalConditionsBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="EnvironmentalConditions[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEnvironmentalConditionsAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpdetailsdeviation" id="eqpdetailsdeviation">
                                            Deviation (if any)<button type="button" id="eqpdetailsdeviationbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="eqpdetailsdeviationdiv">
                                            <div class="singleEqpdetailsdeviationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdetailsdeviation[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpdetailsdeviationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpdetailschangecontrol" id="eqpdetailschangecontrol">
                                            Change Control ( If Any)<button type="button" id="eqpdetailschangecontrolbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="eqpdetailschangecontroldiv">
                                            <div class="singleEqpdetailschangecontrolBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdetailschangecontrol[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpdetailschangecontrolAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpdetailssummary" id="eqpdetailssummary">
                                            Summary<button type="button" id="eqpdetailssummarybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="eqpdetailssummarydiv">

                                            <div class="singleEqpdetailssummaryBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdetailssummary[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subEqpdetailssummaryAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpdetailsconclusion" id="eqpdetailsconclusion">
                                            Conclusion<button type="button" id="eqpdetailsconclusionbtadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="eqpdetailsconclusiondiv">
                                            <div class="singleEqpdetailsconclusionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdetailsconclusion[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-dark subeqpdetailsconclusionAdd" >+</button>

                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="eqpdetailstraining" id="eqpdetailstraining">
                                            Training<button type="button" id="eqpdetailstrainingbtadd" name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="eqpdetailstrainingdiv">
                                            <div class="singleEqpdetailstrainingBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="eqpdetailstraining[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subeqpdetailstrainingAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        --}}


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>File Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachment_ehtsprt"></div>

                                        <div class="add-btn">
                                            <label for="attachment_ehtsprtData" style="cursor: pointer;">Add</label>
                                            <input type="file" id="attachment_ehtsprtData" name="attachment_ehtsprt[]"
                                                oninput="addMultipleFiles(this, 'attachment_ehtsprt')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <!-- Format for compressed air and Nitrogen gas system Report -->

                    <div id="doc-fcreport" class="tabcontent">
                        <div class="orig-head">
                            Format for compressed air and Nitrogen gas system Report
                        </div>
                        {{--
                        <div class="input-fields">
                            <div class="row">
                                 <!-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="objective">Report No.</label>
                                        <textarea name="eqp_report"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="objective">Batch No.</label>
                                        <textarea name="eqp_batch"></textarea>
                                    </div>
                                </div>  -->

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Protocol approval</label>
                                        <textarea name="format_approval"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="objective">Objective</label>
                                        <textarea name="format_objective"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="format_scope"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="formatidentification" id="formatidentification">
                                            Equipment / System Identification <button type="button" id="formatidentificationbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="formatidentificationdiv">
                                            <div class="singleformatidentificationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatidentification[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subformatidentificationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="executiontteam" id="executiontteam">
                                            Execution Team <button type="button" id="executiontteambtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="executiontteamdiv">
                                            <div class="singleexecutiontteamBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="executiontteam[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subexecutiontteamAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="formatdocuments" id="formatdocuments">
                                            Documents To Be Followed <button type="button" id="formatdocumentsbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="formatdocumentsdiv">
                                            <div class="singleformatdocumentsBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatdocuments[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subformatdocumentsAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="revalidationtype" id="revalidationtype">
                                           Type of revalidation <button type="button" id="revalidationtypebtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="revalidationtypediv">
                                            <div class="singlerevalidationtypeBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="revalidationtype[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subrevalidationtypeAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="RevalidationCriteria" id="RevalidationCriteria">
                                           Revalidation criteria<button type="button" id="RevalidationCriteriabtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="RevalidationCriteriadiv">
                                            <div class="singleRevalidationCriteriaBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="RevalidationCriteria[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subRevalidationCriteriaAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="generalconsideration" id="generalconsideration">
                                            General consideration/Prerequisites<button type="button" id="generalconsiderationbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="generalconsiderationdiv">
                                            <div class="singlegeneralconsiderationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="generalconsideration[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subgeneralconsiderationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="precautions" id="precautions">
                                            Precautions<button type="button" id="precautionsbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="precautionsdiv">
                                            <div class="singleprecautionsBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="precautions[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subprecautionsAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="calibrationstatus" id="calibrationstatus">
                                            Test instrument calibration status<button type="button" id="calibrationstatusbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="calibrationstatusdiv">
                                            <div class="singlecalibrationstatusBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="calibrationstatus[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subcalibrationstatusAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="testobservation" id="testobservation">
                                            Revalidation test observation<button type="button" id="testobservationbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="testobservationdiv">

                                            <div class="singletestobservationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="testobservation[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subtestobservationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="formatannexure" id="formatannexure">
                                            Annexure <button type="button" id="formatannexurebtadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="formatannexurediv">
                                            <div class="singleformatannexureBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatannexure[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="btn btn-dark subformatannexureAdd" >+</button>

                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="formatdeviation" id="formatdeviation">
                                           Deviation<button type="button" id="formatdeviationbtadd" name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="formatdeviationdiv">
                                            <div class="singleformatdeviationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatdeviation[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subformatdeviationAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="formatcc" id="formatcc">
                                           Change control<button type="button" id="formatccbtadd" name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="formatccdiv">
                                            <div class="singleformatccBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatcc[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subformatccAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="formatsummary" id="formatsummary">
                                            Summary <button type="button" id="formatsummarybtadd" name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="formatsummarydiv">
                                            <div class="singleformatsummaryBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatsummary[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subformatsummaryAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="formatconclusion" id="formatconclusion">
                                           Conclusion<button type="button" id="formatconclusionbtadd" name="button">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>

                                        <div id="formatconclusiondiv">
                                            <div class="singleformatconclusionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="formatconclusion[]" class=""></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subformatconclusionAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                            </div>
                        </div>
                        --}}

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attach_comp_nitrogen"></div>

                                                <div class="add-btn">
                                                    <label for="attach_comp_nitrogendata" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="attach_comp_nitrogendata" name="attach_comp_nitrogen[]"
                                                        oninput="addMultipleFiles(this, 'attach_comp_nitrogen')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>



                {{-- -----------------Format for comppressed air and nitrgen ges sys protocal  ----------------------- --}}
                <div id="doc-FoCoANGsP" class="tabcontent">
                    <div class="orig-head">
                        Format for Compressed Air and Nitrogen Gas System Protocol
                    </div>
                    <div class="input-fields">
                        <div class="row">
                        {{-- <div class="col-md-12">
                                <div class="group-input">
                                    <label for="Protocolapproval_FoCompAaNirogenkp" id="Protocolapproval_FoCompAaNirogenkp">
                                        Protocol approval<button type="button" id="Protocolapproval_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div> </label>
                                    <div id="Protocolapproval_FoCompAaNirogenkpdiv">
                                        <div class="singleProtocolapproval_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Protocolapproval_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subProtocolapproval_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="Objective_FoCompAaNirogenkp" id="Objective_FoCompAaNirogenkp">
                                        Objective<button type="button" id="Objective_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="Objective_FoCompAaNirogenkpdiv">
                                        <div class="singleObjective_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Objective_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subObjective_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="Purpose_FoCompAaNirogenkp" id="Purpose_FoCompAaNirogenkp">
                                        Purpose<button type="button" id="Purpose_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label><div id="Purpose_FoCompAaNirogenkpdiv">
                                        <div class="singlePurpose_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Purpose_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subPurpose_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="Scope_FoCompAaNirogenkp" id="Scope_FoCompAaNirogenkp">
                                        Scope <button type="button" id="Scope_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="Scope_FoCompAaNirogenkpdiv">
                                        <div class="singleScope_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Scope_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subScope_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="ExcutionTeamResp_FoCompAaNirogenkp" id="ExcutionTeamResp_FoCompAaNirogenkp">
                                        Execution Team Responsibilities<button type="button" id="ExcutionTeamResp_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="ExcutionTeamResp_FoCompAaNirogenkpdiv">
                                        <div class="singleExcutionTeamResp_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ExcutionTeamResp_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subExcutionTeamResp_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="Abbreviations_FoCompAaNirogenkp" id="Abbreviations_FoCompAaNirogenkp">
                                        Abbreviations<button type="button" id="Abbreviations_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="Abbreviations_FoCompAaNirogenkpdiv">
                                        <div class="singleAbbreviations_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Abbreviations_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAbbreviations_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="EquipmentSystemIde_FoCompAaNirogenkp" id="EquipmentSystemIde_FoCompAaNirogenkp">
                                        Equipment / System Identification<button type="button" id="EquipmentSystemIde_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="EquipmentSystemIde_FoCompAaNirogenkpdiv">
                                        <div class="singleEquipmentSystemIde_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="EquipmentSystemIde_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subEquipmentSystemIde_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="DocumentFollowed_FoCompAaNirogenkp" id="DocumentFollowed_FoCompAaNirogenkp">
                                        Documents To Be Followed<button type="button" id="DocumentFollowed_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="DocumentFollowed_FoCompAaNirogenkpdiv">
                                        <div class="singleDocumentFollowed_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="DocumentFollowed_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subDocumentFollowed_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="GenralConsPre_FoCompAaNirogenkp" id="GenralConsPre_FoCompAaNirogenkp">
                                        General consideration/Prerequisites<button type="button" id="GenralConsPre_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="GenralConsPre_FoCompAaNirogenkpdiv">
                                        <div class="singleGenralConsPre_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="GenralConsPre_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subGenralConsPre_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="RevalidCrite_FoCompAaNirogenkp" id="RevalidCrite_FoCompAaNirogenkp">
                                        Revalidation criteria<button type="button" id="RevalidCrite_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="RevalidCrite_FoCompAaNirogenkpdiv">
                                        <div class="singleRevalidCrite_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="RevalidCrite_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subRevalidCrite_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="Precautions_FoCompAaNirogenkp" id="Precautions_FoCompAaNirogenkp">
                                        Precautions<button type="button" id="Precautions_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="Precautions_FoCompAaNirogenkpdiv">
                                        <div class="singlePrecautions_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Precautions_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subPrecautions_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="RevalidProcess_FoCompAaNirogenkp" id="RevalidProcess_FoCompAaNirogenkp">
                                        Revalidation process<button type="button" id="RevalidProcess_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div></label>
                                    <div id="RevalidProcess_FoCompAaNirogenkpdiv">
                                        <div class="singleRevalidProcess_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="RevalidProcess_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subRevalidProcess_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="AcceptanceCrite_FoCompAaNirogenkp" id="AcceptanceCrite_FoCompAaNirogenkp">
                                        Acceptance criteria <button type="button" id="AcceptanceCrite_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="AcceptanceCrite_FoCompAaNirogenkpdiv">
                                        <div class="singleAcceptanceCrite_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="AcceptanceCrite_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAcceptanceCrite_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input"> <label for="Annexure_FoCompAaNirogenkp" id="Annexure_FoCompAaNirogenkp">
                                    Annexure <button type="button" id="Annexure_FoCompAaNirogenkpbtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div> </label>
                                    <div id="Annexure_FoCompAaNirogenkpdiv">
                                        <div class="singleAnnexure_FoCompAaNirogenkpBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Annexure_FoCompAaNirogenkp[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subAnnexure_FoCompAaNirogenkpAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Format For Compressed Air And Nitrogen Gas System Protocol File Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="ForComANiGasProtocolfile_attach"></div>

                                        <div class="add-btn">
                                            <label for="annex_I_gxp_attachmentformateComp" style="cursor: pointer;">Add</label>
                                            <input type="file" id="annex_I_gxp_attachmentformateComp" name="ForComANiGasProtocolfile_attach[]"
                                                oninput="addMultipleFiles(this, 'ForComANiGasProtocolfile_attach')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>




                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>

        <!------------------------ Process validation Report - tab ------------------------------------>



                <div id="doc_pvr" class="tabcontent">
                    <div class="orig-head">
                    Process Validation Report
                        </div>
                    <div class="input-fields">
                        <div class="row">
                     {{--
                        <div class="col-md-6">
                              <div class="group-input">
                                  <label for="purpose">Generic Name </label>
                                  <input type="text" name="generic_pvr">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="group-input">
                                        <label for="scope">Product Code</label>
                                        <input type="text" name="product_code_pvr">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Std. Batch size </label>
                                        <input type="text" name="std_batch_pvr">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Category</label>
                                        <input type="text" name="category_pvr">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Label Claim  </label>
                                        <input type="text" name="label_claim_pvr">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Market</label>
                                        <input type="text" name="market_pvr">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Shelf Life</label>
                                        <input type="text" name="shelf_life_pvr">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">BMR No.</label>
                                        <input type="text" name="bmr_no_pvr">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">MFR No.</label>
                                        <input type="text" name="mfr_no_pvr">
                                    </div>
                                </div>



                         <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="purpose_pvr" id="purpose_pvr">
                                        Purpose <button type="button" id="purpose_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="purpose_pvrdiv">
                                            <div class="singlepurpose_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="purpose_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subpurpose_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">


                                        <label for="scope_pvr" id="scope_pvr">
                                        Scope<button type="button" id="scope_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="scope_pvrdiv">
                                            <div class="singlescope_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="scope_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subscope_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="batchdetail_pvr" id="batchdetail_pvr">
                                        Batch details<button type="button" id="batchdetail_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="batchdetail_pvrdiv">
                                            <div class="singlebatchdetail_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="batchdetail_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subbatchdetail_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="refrence_document_pvr" id="refrence_document_pvr">
                                        Reference Document<button type="button" id="refrence_document_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="refrence_document_pvrdiv">
                                            <div class="singlerefrence_document_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="refrence_document_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subrefrence_document_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="active_raw_material_pvr" id="active_raw_material_pvr">
                                        Active raw material approved vendor details<button type="button" id="active_raw_material_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="active_raw_material_pvrdiv">
                                            <div class="singleactive_raw_material_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="active_raw_material_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subactive_raw_material_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="primary_packingmaterial_pvr" id="primary_packingmaterial_pvr">
                                      Primary packing material approved vendor details<button type="button" id="primary_packingmaterial_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="primary_packingmaterial_pvrdiv">
                                            <div class="singleprimary_packingmaterial_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="primary_packingmaterial_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subprimary_packingmaterial_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="used_equipment_calibration_pvr" id="used_equipment_calibration_pvr">
                                    Used Equipment Calibration and  Qualification status<button type="button" id="used_equipment_calibration_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="used_equipment_calibration_pvrdiv">
                                            <div class="singleused_equipment_calibration_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="used_equipment_calibration_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subused_equipment_calibration_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="result_of_intermediate_pvr" id="result_of_intermediate_pvr">
                                        Results of intermediate Product<button type="button" id="result_of_intermediate_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="result_of_intermediate_pvrdiv">
                                            <div class="singleresult_of_intermediate_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="result_of_intermediate_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subresult_of_intermediate_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="result_of_finished_product_pvr" id="result_of_finished_product_pvr">
                                        Result of Finished Product<button type="button" id="result_of_finished_product_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="result_of_finished_product_pvrdiv">
                                            <div class="singleresult_of_finished_product_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="result_of_finished_product_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subresult_of_finished_product_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="result_of_packing_finished_pvr" id="result_of_packing_finished_pvr">
                                        Results Of Packing (Finished product)<button type="button" id="result_of_packing_finished_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="result_of_packing_finished_pvrdiv">
                                            <div class="singleresult_of_packing_finished_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="result_of_packing_finished_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subresult_of_packing_finished_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="criticalprocess_parameter_pvr" id="criticalprocess_parameter_pvr">
                                    Critical process parameters & Critical quality attributes<button type="button" id="criticalprocess_parameter_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="criticalprocess_parameter_pvrdiv">
                                            <div class="singlecriticalprocess_parameter_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="criticalprocess_parameter_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subcriticalprocess_parameter_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="yield_at_various_stage_pvr" id="yield_at_various_stage_pvr">
                                        Yield at various stages<button type="button" id="yield_at_various_stage_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="yield_at_various_stage_pvrdiv">
                                            <div class="singleyield_at_various_stage_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="yield_at_various_stage_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subyield_at_various_stage_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="hold_time_study_pvr" id="hold_time_study_pvr">
                                        Hold time study<button type="button" id="hold_time_study_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="hold_time_study_pvrdiv">
                                            <div class="singlehold_time_study_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="hold_time_study_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subhold_time_study_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="cleaningvalidation_pvr" id="cleaningvalidation_pvr">
                                        Cleaning validation<button type="button" id="cleaningvalidation_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="cleaningvalidation_pvrdiv">
                                            <div class="singlecleaningvalidation_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="cleaningvalidation_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subcleaningvalidation_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="stability_study_pvr" id="stability_study_pvr">
                                     Stability study<button type="button" id="stability_study_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="stability_study_pvrdiv">
                                            <div class="singlestability_study_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stability_study_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark substability_study_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="deviation_if_any_pvr" id="deviation_if_any_pvr">
                                        Deviation (If any)<button type="button" id="deviation_if_any_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="deviation_if_any_pvrdiv">
                                            <div class="singledeviation_if_any_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="deviation_if_any_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subdeviation_if_any_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="changecontrol_pvr" id="changecontrol_pvr">
                                        Change Control ( If any)<button type="button" id="changecontrol_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="changecontrol_pvrdiv">
                                            <div class="singlechangecontrol_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="changecontrol_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subchangecontrol_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="summary_pvr" id="summary_pvr">
                                        Summary<button type="button" id="summary_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="summary_pvrdiv">
                                            <div class="singlesummary_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="summary_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subsummary_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="conclusion_pvr" id="conclusion_pvr">
                                        Conclusion<button type="button" id="conclusion_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="conclusion_pvrdiv">
                                            <div class="singleconclusion_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="conclusion_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subconclusion_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="proposed_parameter_upcoming_batch_pvr" id="proposed_parameter_upcoming_batch_pvr">
                                        Proposed parameters for upcoming batches<button type="button" id="proposed_parameter_upcoming_batch_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="proposed_parameter_upcoming_batch_pvrdiv">
                                            <div class="singleproposed_parameter_upcoming_batch_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="proposed_parameter_upcoming_batch_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subproposed_parameter_upcoming_batch_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="report_approval_pvr" id="report_approval_pvr">
                                        Report Approval<button type="button" id="report_approval_pvrbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="report_approval_pvrdiv">
                                            <div class="singlereport_approval_pvrBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="report_approval_pvr[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subreport_approval_pvrAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                --}}




                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="file_attach_pvr"></div>

                                                <div class="add-btn">
                                                    <label for="file_attach_pvrData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="file_attach_pvrData" name="file_attach_pvr[]"
                                                        oninput="addMultipleFiles(this, 'file_attach_pvr')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>

  <!------------------------ Process validation protocol - tab ------------------------------------>



                 <div id="doc_cvpd" class="tabcontent">
                    <div class="orig-head">
                    Cleaning Validation Protocol.doc
                        </div>
                    <div class="input-fields">
                        <div class="row">

                            {{--
                                 <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="objective_cvpd" id="objective_cvpd">
                                        Objective <button type="button" id="objective_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="objective_cvpddiv">
                                            <div class="singleobjective_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="objective_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subobjective_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">


                                        <label for="scope_cvpd" id="scope_cvpd">
                                        Scope<button type="button" id="scope_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="scope_cvpddiv">
                                            <div class="singlescope_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="scope_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subscope_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="purpose_cvpd" id="purpose_cvpd">
                                        Purpose <button type="button" id="purpose_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="purpose_cvpddiv">
                                            <div class="singlepurpose_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="purpose_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subpurpose_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="responsibilities_cvpd" id="responsibilities_cvpd">
                                        Responsibilities<button type="button" id="responsibilities_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="responsibilities_cvpddiv">
                                            <div class="singleresponsibilities_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="responsibilities_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subresponsibilities_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="identification_sensitive_product_contamination_cvpd" id="identification_sensitive_product_contamination_cvpd">
                                        Identification of most sensitive product for contamination on
                                        the basis of maximum daily dose & minimum batch size<button type="button" id="identification_sensitive_product_contamination_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="identification_sensitive_product_contamination_cvpddiv">
                                            <div class="singleidentification_sensitive_product_contamination_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="identification_sensitive_product_contamination_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subidentification_sensitive_product_contamination_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="matrix_worstcase_approach_cvpd" id="matrix_worstcase_approach_cvpd">
                                        Matrix Worst Case Approach Table- based on Risk analysis<button type="button" id="matrix_worstcase_approach_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="matrix_worstcase_approach_cvpddiv">
                                            <div class="singlematrix_worstcase_approach_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="matrix_worstcase_approach_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark submatrix_worstcase_approach_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="acceptance_criteria_cvpd" id="acceptance_criteria_cvpd">
                                        Acceptance criteria<button type="button" id="acceptance_criteria_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="acceptance_criteria_cvpddiv">
                                            <div class="singleacceptance_criteria_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="acceptance_criteria_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subacceptance_criteria_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="list_equipment_internal_surface_cvpd" id="list_equipment_internal_surface_cvpd">
                                        List of equipment  with internal Surface area of each equipment in sq.cm<button type="button" id="list_equipment_internal_surface_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="list_equipment_internal_surface_cvpddiv">
                                            <div class="singlelist_equipment_internal_surface_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="list_equipment_internal_surface_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark sublist_equipment_internal_surface_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="identification_clean_surfaces_cvpd" id="identification_clean_surfaces_cvpd">
                                        Identification of difficult to clean surfaces of equipment (Table & drawing) facility<button type="button" id="identification_clean_surfaces_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="identification_clean_surfaces_cvpddiv">
                                            <div class="singleidentification_clean_surfaces_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="identification_clean_surfaces_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subidentification_clean_surfaces_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="sampling_method_cvpd" id="sampling_method_cvpd">
                                        The sampling methods used as per product specific requirement<button type="button" id="sampling_method_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="sampling_method_cvpddiv">
                                            <div class="singlesampling_method_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="sampling_method_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subsampling_method_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="recovery_studies_cvpd" id="recovery_studies_cvpd">
                                        Recovery studies<button type="button" id="recovery_studies_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="recovery_studies_cvpddiv">
                                            <div class="singlerecovery_studies_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="recovery_studies_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subrecovery_studies_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="calculating_carry_over_cvpd" id="calculating_carry_over_cvpd">
                                        Calculating carry over for swab for routine monitoring<button type="button" id="calculating_carry_over_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="calculating_carry_over_cvpddiv">
                                            <div class="singlecalculating_carry_over_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="calculating_carry_over_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subcalculating_carry_over_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="calculating_rinse_analysis_cvpd" id="calculating_rinse_analysis_cvpd">
                                        Calculating carry over for rinse analysis for routine monitoring<button type="button" id="calculating_rinse_analysis_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="calculating_rinse_analysis_cvpddiv">
                                            <div class="singlecalculating_rinse_analysis_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="calculating_rinse_analysis_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subcalculating_rinse_analysis_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="general_procedure_clean_cvpd" id="general_procedure_clean_cvpd">
                                        General Procedure to perform Cleaning Validation <button type="button" id="general_procedure_clean_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="general_procedure_clean_cvpddiv">
                                            <div class="singlegeneral_procedure_clean_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="general_procedure_clean_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subgeneral_procedure_clean_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="analytical_method_validation_cvpd" id="analytical_method_validation_cvpd">
                                        Analytical method validation studies protocol & report<button type="button" id="analytical_method_validation_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="analytical_method_validation_cvpddiv">
                                            <div class="singleanalytical_method_validation_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="analytical_method_validation_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subanalytical_method_validation_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="list_cleaning_sop_cvpd" id="list_cleaning_sop_cvpd">
                                        List of cleaning SOPs & identification of variables<button type="button" id="list_cleaning_sop_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="list_cleaning_sop_cvpddiv">
                                            <div class="singlelist_cleaning_sop_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="list_cleaning_sop_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark sublist_cleaning_sop_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="clean_validation_exercise_cvpd" id="clean_validation_exercise_cvpd">
                                        Cleaning validation exercise<button type="button" id="clean_validation_exercise_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="clean_validation_exercise_cvpddiv">
                                            <div class="singleclean_validation_exercise_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="clean_validation_exercise_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subclean_validation_exercise_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="evaluation_analytical_result_cvpd" id="evaluation_analytical_result_cvpd">
                                        Evaluation of analytical results of the samples<button type="button" id="evaluation_analytical_result_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="evaluation_analytical_result_cvpddiv">
                                            <div class="singleevaluation_analytical_result_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="evaluation_analytical_result_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subevaluation_analytical_result_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="summary_conclusion_cvpd" id="summary_conclusion_cvpd">
                                        Summary & conclusion<button type="button" id="summary_conclusion_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="summary_conclusion_cvpddiv">
                                            <div class="singlesummary_conclusion_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="summary_conclusion_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subsummary_conclusion_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="training_cvpd" id="training_cvpd">
                                        Training<button type="button" id="training_cvpdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="training_cvpddiv">
                                            <div class="singletraining_cvpdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="training_cvpd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subtraining_cvpdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                         --}}

                                <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attach_cvpd"></div>

                                                <div class="add-btn">
                                                    <label for="annex_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_I_gxp_attachment" name="attach_cvpd[]"
                                                        oninput="addMultipleFiles(this, 'attach_cvpd')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>



                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>



 <!------------------------ Process validation Report - tab ------------------------------------>



                <div id="doc_cvrd" class="tabcontent">
                            <div class="orig-head">
                                 Cleaning Validation Report.doc
                            </div>
                            <div class="input-fields">
                                <div class="row">

                              {{--
                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="objective_cvrd" id="objective_cvrd">
                                        Objective <button type="button" id="objective_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="objective_cvrddiv">
                                            <div class="singleobjective_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="objective_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subobjective_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">


                                        <label for="scope_cvrd" id="scope_cvrd">
                                        Scope<button type="button" id="scope_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="scope_cvrddiv">
                                            <div class="singlescope_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="scope_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subscope_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="purpose_cvrd" id="purpose_cvrd">
                                        Purpose <button type="button" id="purpose_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="purpose_cvrddiv">
                                            <div class="singlepurpose_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="purpose_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subpurpose_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="responsibilities_cvrd" id="responsibilities_cvrd">
                                        Responsibilities<button type="button" id="responsibilities_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>



                                        <div id="responsibilities_cvrddiv">
                                            <div class="singleresponsibilities_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="responsibilities_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subresponsibilities_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="analysis_methodology_cvrd" id="analysis_methodology_cvrd">
                                        Analysis Methodology<button type="button" id="analysis_methodology_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>


                                        <div id="analysis_methodology_cvrddiv">
                                            <div class="singleanalysis_methodology_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="analysis_methodology_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subanalysis_methodology_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>




                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="recovery_study_report_cvrd" id="recovery_study_report_cvrd">
                                        Recovery Study Report<button type="button" id="recovery_study_report_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="recovery_study_report_cvrddiv">
                                            <div class="singlerecovery_study_report_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="recovery_study_report_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subrecovery_study_report_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="acceptance_critria_cvrd" id="acceptance_critria_cvrd">
                                        Acceptance Criteria <button type="button" id="acceptance_critria_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="acceptance_critria_cvrddiv">
                                            <div class="singleacceptance_critria_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="acceptance_critria_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subacceptance_critria_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="analytical_report_cvrd" id="analytical_report_cvrd">
                                        Analytical  Report<button type="button" id="analytical_report_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="analytical_report_cvrddiv">
                                            <div class="singleanalytical_report_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="analytical_report_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subanalytical_report_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="physical_procedure_conformance_check_cvrd" id="physical_procedure_conformance_check_cvrd">
                                        Physical check & procedure conformance check<button type="button" id="physical_procedure_conformance_check_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="physical_procedure_conformance_check_cvrddiv">
                                            <div class="singlephysical_procedure_conformance_check_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="physical_procedure_conformance_check_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subphysical_procedure_conformance_check_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">

                                        <label for="conclusion_cvrd" id="conclusion_cvrd">
                                        Conclusion<button type="button" id="conclusion_cvrdbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="conclusion_cvrddiv">
                                            <div class="singleconclusion_cvrdBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="conclusion_cvrd[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subconclusion_cvrdAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                              --}}




                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="file_attach_cvrd"></div>

                                                <div class="add-btn">
                                                    <label for="file_attach_cvrdData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="file_attach_cvrdData" name="file_attach_cvrd[]"
                                                        oninput="addMultipleFiles(this, 'file_attach_cvrd')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>



               <!------------------------ STABILITY STUDY PROTOCOL - tab ------------------------------------>



                        <div id="doc_ssp" class="tabcontent">
                            <div class="orig-head">
                            STABILITY STUDY PROTOCOL
                            </div>
                            <div class="input-fields">
                                <div class="row">


                                <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="file_attach"></div>

                                                <div class="add-btn">
                                                    <label for="file_attachDataSSP" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="file_attachDataSSP" name="file_attach[]"
                                                        oninput="addMultipleFiles(this, 'file_attach')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>


                            {{--
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">PRODUCT NAME </label>
                                        <input type="text" name="product_name_ssp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Protocol No.</label>
                                        <input type="text" name="protocol_no_ssp">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Brand Name </label>
                                        <input type="text" name="brand_name_ssp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Generic Name </label>
                                        <input type="text" name="generic_name_ssp">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Label Claim </label>
                                        <input type="text" name="label_claim_ssp">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">FG Code</label>
                                        <input type="text" name="fg_code_ssp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Pack Size </label>
                                        <input type="text" name="pack_size_ssp">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Shelf Life</label>
                                        <input type="text" name="shelf_life_ssp">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Market</label>
                                        <input type="text" name="market_ssp">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Storage condition</label>
                                        <input type="text" name="storage_condition_ssp">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="change_related_to">PURPOSE</label>

                                        <select name="purpose_ssp" id="change_related_to">
                                            <option value="">-- Select --</option>
                                            <option value="New Product" {{ old('purpose_ssp', property_exists($data ?? (object)[], 'purpose_ssp') ? $data->purpose_ssp : '') == 'New Product' ? 'selected' : '' }}>New Product</option>
                                            <option value="Change in Process" {{ old('purpose_ssp', property_exists($data ?? (object)[], 'purpose_ssp') ? $data->purpose_ssp : '') == 'Change in Process' ? 'selected' : '' }}>Change in Process</option>
                                            <option value="Change in batch size" {{ old('purpose_ssp', property_exists($data ?? (object)[], 'purpose_ssp') ? $data->purpose_ssp : '') == 'Change in batch size' ? 'selected' : '' }}>Change in batch size</option>
                                            <option value="Change in packing material" {{ old('purpose_ssp', property_exists($data ?? (object)[], 'purpose_ssp') ? $data->purpose_ssp : '') == 'Change in packing material' ? 'selected' : '' }}>Change in packing material</option>
                                            <option value="Ongoing batch" {{ old('purpose_ssp', property_exists($data ?? (object)[], 'purpose_ssp') ? $data->purpose_ssp : '') == 'Ongoing batch' ? 'selected' : '' }}>Ongoing batch</option>
                                            <option value="other" {{ old('purpose_ssp', property_exists($data ?? (object)[], 'purpose_ssp') ? $data->purpose_ssp : '') == 'other' ? 'selected' : '' }}>Other</option>
                                        </select>


                                    </div>
                                </div>



                                <div class="col-lg-6" id="other_specify_div" style="display:none;">
                                    <div class="group-input">
                                        <label for="other_specify">Please specify</label>
                                        <input type="text" name="specify_ssp" id="other_specify" value="{{ property_exists($data ?? (object)[], 'specify_ssp') }}" placeholder="Specify if Other is selected">

                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        function toggleOtherSpecifyField() {
                                            var changeRelatedTo = $('#change_related_to').val();
                                            if (changeRelatedTo === 'other') {
                                                $('#other_specify_div').show();
                                            } else {
                                                $('#other_specify_div').hide();
                                            }
                                        }

                                        toggleOtherSpecifyField(); // Initial check

                                        // Update field visibility on dropdown change
                                        $('#change_related_to').change(function() {
                                            toggleOtherSpecifyField();
                                        });
                                    });
                                </script>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="change_related_to">SCOPE </label>

                                        <select name="scope_ssp" id="change_related_to">
                                            <option value="">-- Select --</option>
                                            <option value="Exhibit Batch" {{ old('scope_ssp', property_exists($data ?? (object)[], 'scope_ssp') ? $data->scope_ssp : '') == 'Exhibit Batch' ? 'selected' : '' }}>Exhibit Batch</option>
                                            <option value="Commercial Validation batch" {{ old('scope_ssp', property_exists($data ?? (object)[], 'scope_ssp') ? $data->scope_ssp : '') == 'Commercial Validation batch' ? 'selected' : '' }}>Commercial Validation batch</option>
                                            <option value="Commercial Annual batch" {{ old('scope_ssp', property_exists($data ?? (object)[], 'scope_ssp') ? $data->scope_ssp : '') == 'Commercial Annual batch' ? 'selected' : '' }}>Commercial Annual batch</option>
                                        </select>


                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">DOCUMENT REFERENCES</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="documentrefrence_ssp" class="summernote">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">REASON FOR STABILITY</label>
                                        <input type="text" name="reason_stability_ssp">
                                    </div>
                                </div>



                                <div class="group-input">
                            <label for="action-plan-grid">
                                BATCH DETAILS
                                <button type="button" id="batch_details_ssp">+</button>
                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    Row Increment
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="batch_detailData_ssp">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">Sr.No</th>
                                            <th style="width: 20%">Batch Number</th>
                                            <th style="width: 20%">Batch Size</th>
                                            <th style="width: 20%">Manufacturing Date</th>
                                            <th style="width: 20%">Expiry Date</th>
                                            <th style="width: 10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $serialNumber = 1;
                                        @endphp
                                        <tr>
                                            <td><input type="text" disabled value="{{ $serialNumber }}"></td>
                                            <td><input type="text" name="batch_details_ssp[0][batch_no]"></td>
                                            <td><input type="text" name="batch_details_ssp[0][batch_size]"></td>
                                            <td><input type="text" class="datepicker" name="batch_details_ssp[0][manufacture_date]" placeholder="DD-MMM-YYYY"></td>
                                            <td><input type="text" class="datepicker" name="batch_details_ssp[0][expiry_date]" placeholder="DD-MMM-YYYY"></td>
                                            <td><button type="button" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                let investdetails = 1;

                                function initializeDatepickers() {
                                    $(".datepicker").datepicker({
                                        dateFormat: "dd-M-yy"
                                    });
                                }

                                $('#batch_details_ssp').click(function() {
                                    let rowCount = $('#batch_detailData_ssp tbody tr').length;
                                    let newRow = `
                                        <tr>
                                            <td><input type="text" disabled value="${rowCount + 1}"></td>
                                            <td><input type="text" name="batch_details_ssp[${investdetails}][batch_no]"></td>
                                            <td><input type="text" name="batch_details_ssp[${investdetails}][batch_size]"></td>
                                            <td><input type="text" class="datepicker" name="batch_details_ssp[${investdetails}][manufacture_date]" placeholder="DD-MMM-YYYY"></td>
                                            <td><input type="text" class="datepicker" name="batch_details_ssp[${investdetails}][expiry_date]" placeholder="DD-MMM-YYYY"></td>
                                            <td><button type="button" class="removeRowBtn">Remove</button></td>
                                        </tr>`;

                                    $('#batch_detailData_ssp tbody').append(newRow);
                                    initializeDatepickers();
                                    investdetails++;
                                });

                                $(document).on('click', '.removeRowBtn', function() {
                                    $(this).closest('tr').remove();
                                    $('#batch_detailData_ssp tbody tr').each(function(index) {
                                        $(this).find('td:first input').val(index + 1);
                                    });
                                });

                                initializeDatepickers();
                            });
                        </script>



                            <!-- <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Storage Conditions</th>
                                            <th rowspan="2">Orientation</th>
                                            <th colspan="12">Interval (Month)</th>
                                        </tr>
                                        <tr>
                                            @foreach([1, 2, 3, 6, 9, 12, 18, 24, 36, 48, 60, 72] as $month)
                                                <th>{{ $month }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $conditions = [
                                                'Accelerated (40°C ± 2°C and 75% ± 5% RH)',
                                                'Long Term (25°C ± 2°C and 60% ± 5% RH)',
                                                'Long Term (30°C ± 2°C and 65% ± 5% RH)',
                                                'Long Term (30°C ± 2°C and 75% ± 5% RH)',
                                            ];
                                        @endphp

                                        @foreach($conditions as $key => $condition)
                                            <tr>
                                                <td>{{ $condition }}</td>
                                                <td><input type="text" name="orientation[{{ $key }}]" class="form-control"></td>
                                                @foreach([1, 2, 3, 6, 9, 12, 18, 24, 36, 48, 60, 72] as $month)
                                                    <td>
                                                        <input type="checkbox" name="intervals[{{ $key }}][{{ $month }}]" value="{{ $month }}">
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>



                            <div class="container">
                                <h3 class="mb-3">Quantity Required</h3>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Storage Conditions</th>
                                            <th colspan="12">Interval (Month)</th>
                                            <th rowspan="2">Add. Qty.</th>
                                            <th rowspan="2">Total Qty.</th>
                                        </tr>
                                        <tr>
                                            @foreach([1, 2, 3, 6, 9, 12, 18, 24, 36, 48, 60, 72] as $month)
                                                <th>{{ $month }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $conditions = [
                                                'Accelerated (40°C ± 2°C and 75% ± 5% RH)',
                                                'Long Term (25°C ± 2°C and 60% ± 5% RH)',
                                                'Long Term (30°C ± 2°C and 65% ± 5% RH)',
                                                'Long Term (30°C ± 2°C and 75% ± 5% RH)',
                                            ];
                                        @endphp

                                        @foreach($conditions as $key => $condition)
                                            <tr>
                                                <td>{{ $condition }}</td>
                                                @foreach([1, 2, 3, 6, 9, 12, 18, 24, 36, 48, 60, 72] as $month)
                                                    <td>
                                                        <input type="number" name="quantities[{{ $key }}][{{ $month }}]" class="form-control" min="0">
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <input type="number" name="additional_qty[{{ $key }}]" class="form-control" min="0">
                                                </td>
                                                <td>
                                                    <input type="number" name="total_qty[{{ $key }}]" class="form-control" min="0" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td><strong>Total</strong></td>
                                            <td colspan="12" class="text-center"><strong>Not applicable</strong></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div> -->

                            <div class="group-input">
                                            <label for="action-plan-grid">
                                            DETAILS<button type="button" name="action-plan-grid"
                                                        id="Secondbatch_details_ssp">+</button>
                                                <span class="text-primary" data-bs-toggle="modal"
                                                    data-bs-target="#observation-field-instruction-modal"
                                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                Row Increment
                                                </span>
                                            </label>
                                        <div class="table-responsive">
                                                <table class="table table-bordered" id="Secondbatch_detailData_ssp">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 2%">Sr.No</th>
                                                            <th style="width: 12%">Stability station</th>
                                                            <th style="width: 12%">Required tests</th>

                                                            <th style="width: 3%">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        <td disabled>{{ $serialNumber++ }}</td>

                                                        <td><input type="text" name="batch_detaildata_ssp[0][stability_station]"></td>
                                                        <td><input type="text" name="batch_detaildata_ssp[0][req_test]"></td>
                                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                                    </tbody>

                                                </table>
                                        </div>
                                    </div>

                                    <script>
                                    $(document).ready(function() {
                                        let investdetails = 1;
                                        $('#Secondbatch_details_ssp').click(function(e) {
                                            function generateTableRow(serialNumber) {
                                                var users = @json($users);
                                                console.log(users);
                                                var html =
                                                        '<tr>' +
                                                        '<td><input disabled type="text" style ="width:15px" value="' + serialNumber +
                                                        '"></td>' +
                                                        '<td><input type="text" name="batch_detaildata_ssp[' + investdetails +
                                                        '][stability_station]" value=""></td>' +

                                                        '<td><input type="text" name="batch_detaildata_ssp[' + investdetails +
                                                        '][req_test]" value=""></td>' +


                                                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                                                        '</tr>';


                                                    return html;
                                                }

                                                var tableBody = $('#Secondbatch_detailData_ssp tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
                            </script>





                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="others">Remark (if any)</label>
                                        <textarea name="remark_if_any_ssp"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">STABILITY DATA COMPILATION</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="stability_data_ssp" class="summernote">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">GENERAL INSTRUCTIONS</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="general_inst_ssp" class="summernote">
                                    </textarea>
                                    </div>
                                </div>


                            <div class="orig-head">
                                PROTOCOL CERTIFICATION
                            </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Stability Protocol For </label>
                                        <input type="text" name="stability_proto_ssp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Protocol No.</label>
                                        <input type="text" name="proto_no_ssp">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Product</label>
                                        <input type="text" name="product_ssp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Batch Number</label>
                                        <input type="text" name="batchnumber_ssp">
                                    </div>
                                </div>

                                --}}

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>

               <!------------------------ Validation Master Plan - tab ------------------------------------>

                <div id="doc_vmp" class="tabcontent">
                            <div class="orig-head">
                            Validation Master Plan
                            </div>
                            <div class="input-fields">
                                <div class="row">


                                <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="file_attach_vmp"></div>

                                                <div class="add-btn">
                                                    <label for="file_attach_vmpData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="file_attach_vmpData" name="file_attach_vmp[]"
                                                        oninput="addMultipleFiles(this, 'file_attach_vmp')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>

        <!------------------------ Validation Master Plan - tab ------------------------------------>



                <div id="doc_qm" class="tabcontent">
                            <div class="orig-head">
                            Quality Manual 
                            </div>
                            <div class="input-fields">
                                <div class="row">


                                <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="file_attach_qm"></div>

                                                <div class="add-btn">
                                                    <label for="file_attach_qmData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="file_attach_qmData" name="file_attach_qm[]"
                                                        oninput="addMultipleFiles(this, 'file_attach_qm')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
                <!-- GTP -->
                <div id="doc-gtp" class="tabcontent">
                        <div class="orig-head">
                         GENERAL TESTING PROCEDURE
                        </div>
                    <div class="input-fields">
                        <div class="row">


                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="comments">Product/Material Name</label>
                                    <input type="text" name="gtp_product_material_name">
                                </div>
                            </div>



                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Test</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="gtp_test" class="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="group-input">
                                    <label for="action-plan-grid">
                                        Revision History<button type="button" name="action-plan-grid"
                                                id="Details_add_gtp">+</button>
                                    </label>
                                    <div class="table-responsive">
                                            <table class="table table-bordered" id="Details-table-gtp">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">Sr. No.</th>
                                                        <th class="">Revision No.</th>
                                                        <th class="">Change Control No.</th>
                                                        <th class="">Effective Date</th>
                                                        <th class="">Reason of revision</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $serialNumber = 1;
                                                    @endphp
                                                    <td disabled>{{ $serialNumber++ }}</td>
                                                    <td><input type="text" name="gtp[0][revision_no_gtp]"></td>
                                                    <td><input type="text" name="gtp[0][changContNo_gtp]"></td>
                                                    <td><input type="date" name="gtp[0][effectiveDate_gtp]"></td>
                                                    <td><input type="text" name="gtp[0][reasonRevi_gtp]"></td>
                                                </tbody>

                                            </table>
                                    </div>
                                </div>

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        let investdetails = 1;
                        $('#Details_add_gtp').click(function(e) {
                            function generateTableRow(serialNumber) {
                                var users = @json($users);
                                console.log(users);
                                var html =
                                        '<tr>' +
                                        '<td><input disabled type="text" style ="width:15px" value="' + serialNumber +
                                        '"></td>' +
                                        '<td><input type="text" name="gtp[' + investdetails +
                                        '][revision_no_gtp]" value=""></td>' +
                                        '<td><input type="text" name="gtp[' + investdetails +
                                        '][changContNo_gtp]" value=""></td>' +
                                        '<td><input type="date" name="gtp[' + investdetails +
                                        '][effectiveDate_gtp]" value=""></td>' +                                        
                                        '<td><input type="text" name="gtp[' + investdetails +
                                        '][reasonRevi_gtp]" value=""></td>' +
                                        '</tr>';

                                    return html;
                                }

                                var tableBody = $('#Details-table-gtp tbody');
                                var rowCount = tableBody.children('tr').length;
                                var newRow = generateTableRow(rowCount + 1);
                                tableBody.append(newRow);
                            });
                        });
                </script>

                <script>
                    $(document).on('click', '.removeRowBtn', function() {
                        $(this).closest('tr').remove();
                    })
                </script>


                <!-- Protocol Cum Report -->
                    <div id="doc_qpcr" class="tabcontent">
                        <div class="orig-head">
                            Qualification Protocol Cum Report
                        </div>
                        <div class="input-fields">
                            <div class="row">


                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="procumrepo_file_attach"></div>

                                                <div class="add-btn">
                                                    <label for="procumrepo_file_attachData" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="procumrepo_file_attachData" name="procumrepo_file_attach[]"
                                                        oninput="addMultipleFiles(this, 'procumrepo_file_attach')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                <!------------------------ RMSTP tab ------------------------------------>
                <div id="doc_rmstp" class="tabcontent">
                        <div class="orig-head">
                            RAW MATERIAL STANDARD TESTING PROCEDURE
                        </div>
                    <div class="input-fields">
                        <div class="row">

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Product Name</label>
                                        <input type="text" name="product_name_rawmstp">
                                    </div>
                                </div>

                                <div class="col-12 sub-head">
                                    Standard Testing Procedure
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="rawmaterials_testing" class="summernote"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="group-input">
                                    <label for="action-plan-grid">
                                        Details<button type="button" name="action-plan-grid"
                                                id="Details_add">+</button>

                                    </label>
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">Sr.No</th>
                                                    <th style="width: 12%">Test</th>
                                                    <th style="width: 3%">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                    $serialNumber = 1;
                                                @endphp
                                                <td disabled>{{ $serialNumber++ }}</td>

                                                <td><input type="text" name="test[0][testdata]"></td>
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>

                                        </table>
                                </div>
                            </div> --}}


                            {{-- <div class="col-md-12">
                                <div class="group-input">
                                    <label for="short-desc">STP No.</label>

                                    <input type="text" id="" name="stp_no">
                                </div>

                            </div> --}}

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        let investdetails = 1;
                        $('#Details_add').click(function(e) {
                            function generateTableRow(serialNumber) {
                                var users = @json($users);
                                console.log(users);
                                var html =
                                        '<tr>' +
                                        '<td><input disabled type="text" style ="width:15px" value="' + serialNumber +
                                        '"></td>' +
                                        '<td><input type="text" name="test[' + investdetails +
                                        '][testdata]" value=""></td>' +


                                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                                        '</tr>';


                                    return html;
                                }

                                var tableBody = $('#Details-table tbody');
                                var rowCount = tableBody.children('tr').length;
                                var newRow = generateTableRow(rowCount + 1);
                                tableBody.append(newRow);
                            });
                        });
                </script>

                <script>
                    $(document).on('click', '.removeRowBtn', function() {
                        $(this).closest('tr').remove();
                    })
                </script>



                 <!--Process Validation Protocol  -->
                <div id="doc_prvp" class="tabcontent">
                    <div class="orig-head">
                        PROCESS VALIDATION PROTOCOL
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Generic Name </label>
                                        <input type="text" name="generic_prvp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Product Code</label>
                                        <input type="text" name="prvp_product_code">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Std. Batch size </label>
                                        <input type="text" name="prvp_std_batch">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Category</label>
                                        <input type="text" name="prvp_category">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Label Claim  </label>
                                        <input type="text" name="prvp_label_claim">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Market</label>
                                        <input type="text" name="prvp_market">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Shelf Life</label>
                                        <input type="text" name="prvp_shelf_life">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">BMR No.</label>
                                        <input type="text" name="prvp_bmr_no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">MFR No.</label>
                                        <input type="text" name="prvp_mfr_no">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Purpose</label>
                                        <textarea name="prvp_purpose"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Scope</label>
                                        <textarea name="prvp_scope"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Reason for validation</label>
                                        <textarea name="reason_validation"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="responsibility" id="responsibility">
                                            Responsibility<button type="button" id="responsibilityprvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="responsibilityprvpdiv">
                                            <div class="singleResponsibilityPrvpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="responsibilityprvp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subResponsibilityprvpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Validation Policy</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="validation_po_prvp" class="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Description of SOP</label>
                                        <textarea name="description_sop_prvp"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="accountability" id="accountability">
                                        Active raw material approved vendor details <button type="button" id="accountabilityprvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="accountabilityprvpdiv">
                                            <div class="singleAccountabilityPrvpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="prvp_rawmaterial[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAccountabilityprvpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="references" id="referencesprvp">
                                        Primary packing material approved vendor details<button type="button" id="referencesprvpbtadd">+</button>
                                        </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <div id="referencesprvpdiv">
                                            <div class="singleReferencesPrvpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="pripackmaterial[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subReferencesPrvpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="abbreviation" id="abbreviationprvp">
                                        Equipment Calibration & Qualification Status<button type="button" id="abbreviationprvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="abbreviationprvpdiv">
                                            <div class="singleAbbreviationPrvpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="equipCaliQuali[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subAbbreviationPrvpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="abbreviation" id="definitionprvp">
                                        Rationale for selection of critical steps<button type="button" id="DefinitionPrvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="definitionprvpdiv">
                                            <div class="singleDefinitionPrvpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="rationale_critical[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subDefinitionPrvpAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Manufacturing Process Flow Chart <button type="button" id="materialsgeneralbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="materialsGeneraldiv">
                                            <div class="singleMaterialGeneralBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="general_instrument[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subMaterialsGenAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Process Flow Chart <button type="button" id="processflowbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="processFlowdiv">
                                            <div class="singleProcessFlowBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="process_flow[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subProcessFlowAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Sampling Plan, Procedure and rationale</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="prvp_procedure" class="summernote">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Diagrammatic representation of Sampling points<button type="button" id="diagrammaticbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="diagrammaticdiv">
                                            <div class="singleDiagrammaticBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="diagrammatic[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subDiagrammaticAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                             Critical Process Parameters & Critical Process Attributes<button type="button" id="criticalprocessbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="criticaldiv">
                                            <div class="singleCriticalBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="critical_process[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subCriticalAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Product Acceptance Criteria<button type="button" id="productacceptancebtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="productaccpdiv">
                                            <div class="singleProductAccpBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="product_acceptance[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subProductAccpAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Hold time study<button type="button" id="holdtimebtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="holdtimestudydiv">
                                            <div class="singleHoldTimeBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="holdtime_study[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subHoldTimeAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Cleaning validation<button type="button" id="cleaningvalibtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="cleaningvalidiv">
                                            <div class="singleCleaningValiBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="cleaning_validation[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subCleaningValiAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Stability study<button type="button" id="stabilitystudybtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="stabilitystudydiv">
                                            <div class="singleStabilityStudyBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="stability_study[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subStabilityAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Deviation<button type="button" id="deviationbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="deviationdiv">
                                            <div class="singleDeviationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="deviation[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subDeviationAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Change control<button type="button" id="changecontrolbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="changecontroldiv">
                                            <div class="singleChangeControlBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="change_control[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subChangeControlAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Summary<button type="button" id="summaryprvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="summaryprvpdiv">
                                            <div class="singleSummaryBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="summary_prvp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subSummaryPrvpAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Conclusion<button type="button" id="conclusionprvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="conclusionprvpdiv">
                                            <div class="singleConclusionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="conclusion_prvp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subConclusionPrvpAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="reporting" id="newreport">
                                            Training<button type="button" id="trainingprvpbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="trainingprvpdiv">
                                            <div class="singleTrainingBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="training_prvp[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="button" class="subTrainingPrvpAdd"
                                                            name="button">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="File_Attachment"><b>Process Validation Protocol  File Attachment</b></label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="ProValProtocol"></div>

                                            <div class="add-btn">
                                                <label for="ProValProtocol_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                                <input type="file" id="ProValProtocol_I_gxp_attachment" name="ProValProtocol[]"
                                                    oninput="addMultipleFiles(this, 'ProValProtocol')" multiple hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                </script>

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>



                <!------------------------ Packing Material Specification - tab ------------------------------------>
                <div id="doc_pams" class="tabcontent">
                    <div class="orig-head">
                        PACKING MATERIAL SPECIFICATION
                        </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="group-input">
                                    <label for="packing_material_name">Material Name</label>
                                    <input type="text" name="packing_material_name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="item_code">Item Code</label>
                                        <input type="text" name="item_code">
                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Name of packing material</label>
                                        <input type="text" name="name_pack_material">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Standard pack</label>
                                        <input type="text" name="standard_pack">
                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Sampling plan</label>
                                        <input type="text" name="sampling_plan">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Sampling Instructions</label>
                                        <input type="text" name="sampling_instruction">
                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Sample for analysis </label>
                                        <input type="text" name="sample_analysis">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Control Sample</label>
                                        <input type="text" name="control_sample">
                                    </div>
                            </div>

                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Safety Precautions</label>
                                        <input type="text" name="safety_precaution">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Storage condition</label>
                                        <input type="text" name="storage_condition">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Approved Vendors</label>
                                        <input type="text" name="approved_vendor">
                                    </div>
                            </div>

                            <!-- <div class="group-input">
                                <label for="action-plan-grid">
                                    Details
                                    <button type="button" id="Details_add_data">+</button>
                                </label>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="Details_table_data">
                                        <thead>
                                            <tr>
                                                <th style="width: 2%">Sr.No</th>
                                                <th style="width: 12%">Tests</th>
                                                <th style="width: 12%">Specifications</th>
                                                <th style="width: 12%">GTP No.</th>
                                                <th style="width: 3%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $serialNumber = 1; @endphp
                                            <tr>
                                                <td><input type="text" disabled value="{{ $serialNumber++ }}"></td>
                                                <td><input type="text" name="packingtest[0][tests]"></td>
                                                <td><input type="text" name="packingtest[0][specification]"></td>
                                                <td><input type="text" name="packingtest[0][gtp_no]"></td>
                                                <td><button type="button" class="removeRowBtn">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> -->

                            <div class="col-12 sub-head">
                                    SPECIFICATION
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="packingmaterial_specification" class="summernote"></textarea>
                                    </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    let investdetails = 1; // Start with 1 since we already have one row

                                    $('#Details_add_data').click(function() {
                                        let rowCount = $('#Details_table_data tbody tr').length; // Get current row count
                                        let newRow = `
                                            <tr>
                                                <td><input type="text" disabled value="${rowCount + 1}"></td>
                                                <td><input type="text" name="packingtest[${investdetails}][tests]" value=""></td>
                                                <td><input type="text" name="packingtest[${investdetails}][specification]" value=""></td>
                                                <td><input type="text" name="packingtest[${investdetails}][gtp_no]" value=""></td>
                                                <td><button type="button" class="removeRowBtn">Remove</button></td>
                                            </tr>
                                        `;
                                        $('#Details_table_data tbody').append(newRow);
                                        investdetails++; // Increment the index for next row
                                    });

                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                        updateRowNumbers();
                                    });

                                    function updateRowNumbers() {
                                        $('#Details_table_data tbody tr').each(function(index) {
                                            $(this).find('td:first-child input').val(index + 1); // Update serial numbers
                                            $(this).find('input[name^="packingtest"]').each(function() {
                                                let fieldName = $(this).attr("name");
                                                let updatedName = fieldName.replace(/\[\d+\]/, `[${index}]`);
                                                $(this).attr("name", updatedName);
                                            });
                                        });
                                        investdetails = $('#Details_table_data tbody tr').length; // Reset counter
                                    }
                                });
                            </script>

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>












            <!------------------------ PRODUCT / ITEM INFORMATION - ADDENDUM FOR SPECIFICATION ------------------------------------>
                        <div id="doc_pias" class="tabcontent">
                                    <div class="orig-head">
                                    PRODUCT / ITEM INFORMATION - ADDENDUM FOR SPECIFICATION
                                    </div>
                                <div class="input-fields">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="packing_material_name">Product Name</label>
                                                <input type="text" name="pia_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="group-input">
                                                <label for="comments">Code</label>
                                                <select name="pia_name_code" id="">
                                                    <option value="">Select here</option>
                                                    <option value="FP">Finished Product</option>
                                                    <option value="IP">Inprocess Product</option>
                                                    <option value="CV">Cleaning Validation</option>
                                                    <option value="RW">Raw Material</option>
                                                    <option value="CM">Consumable</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- <div class="col-md-12">
                                            <div class="group-input">
                                                <label for="packing_material_name">Product Name</label>
                                                <input type="text" name="pia_name">
                                            </div>
                                        </div> -->


                                <div class="group-input">
                                    <label for="action-plan-grid">
                                    For Finished product specification use below table<button type="button" name="action-plan-grid"
                                                id="addRowBtndata">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="productDetailsTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">Sr.No</th>
                                                    <th style="width: 2%">Product Code</th>
                                                    <th style="width: 2%">FG Code</th>
                                                    <th style="width: 2%">Country</th>
                                                    <th style="width: 2%">Brand Name / Grade</th>
                                                    <th style="width: 2%">Pack Size</th>
                                                    <th style="width: 2%">Shelf Life</th>
                                                    <th style="width: 2%">Sample Quantity</th>
                                                    <th style="width: 2%">Storage Condition</th>
                                                    <th style="width: 2%">Prepared by Quality Person (Sign/Date)</th>
                                                    <th style="width: 2%">Checked by QC (HOD/Designee) (Sign/Date)</th>
                                                    <th style="width: 2%">Approved by QA (HOD/Designee) (Sign/Date)</th>
                                                    <th style="width: 3%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td><input disabled type="text" style="width:15px" value="1"></td>
                                                <td><input type="text" name="product[0][product_code]"></td>
                                                <td><input type="text" name="product[0][fg_code]"></td>
                                                <td><input type="text" name="product[0][country]"></td>
                                                <td><input type="text" name="product[0][brand_name_grade]"></td>
                                                <td><input type="text" name="product[0][pack_size]"></td>
                                                <td><input type="text" name="product[0][shelf_life]"></td>
                                                <td><input type="text" name="product[0][sample_quantity]"></td>
                                                <td><input type="text" name="product[0][storage_condition]"></td>
                                                <td><input type="text" name="product[0][prepared_by_quality_person]"></td>
                                                <td><input type="text" name="product[0][checked_by_qc_hod_designee]"></td>
                                                <td><input type="text" name="product[0][approved_by_qa_hod_designee]"></td>
                                                <td><button type="button" class="removeRowBtn">Remove</button></td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        function addSpecifications() {
                                            let table = document.getElementById("specifications-grid").getElementsByTagName('tbody')[0];
                                            let rowCount = table.rows.length;
                                            let newRow = table.insertRow();
                                            newRow.innerHTML = `
                                                <td>${rowCount + 1}</td>
                                                <td><input type="text" name="specifications[${rowCount}][tests]"></td>
                                                <td><input type="text" name="specifications[${rowCount}][release]"></td>
                                                <td><input type="text" name="specifications[${rowCount}][shelf_life]"></td>
                                                <td><input type="text" name="specifications[${rowCount}][reference]"></td>
                                                <td><button type="button" class="removeSpecRow">Remove</button></td>
                                            `;
                                        }

                                        document.addEventListener("click", function (event) {
                                            if (event.target.classList.contains("removeSpecRow")) {
                                                let row = event.target.closest("tr");
                                                row.remove();
                                                updateSerialNumbers();
                                            }
                                        });

                                        function updateSerialNumbers() {
                                            let rows = document.querySelectorAll("#specifications-grid tbody tr");
                                            rows.forEach((row, index) => {
                                                row.cells[0].textContent = index + 1;
                                                row.querySelectorAll("input").forEach(input => {
                                                    let nameParts = input.name.match(/specifications\[\d+]\[(.+)]/);
                                                    if (nameParts) {
                                                        input.name = `specifications[${index}][${nameParts[1]}]`;
                                                    }
                                                });
                                            });
                                        }

                                        window.addSpecifications = addSpecifications;
                                    });

                                </script>




                                <script>
                                    $(document).ready(function () {
                                        let investDetails = 1; // Row counter

                                        $('#addRowBtndata').click(function () {
                                            function generateTableRow(serialNumber) {
                                                return `<tr>
                                                    <td><input disabled type="text" style="width:15px" value="${serialNumber}"></td>
                                                    <td><input type="text" name="product[${investDetails}][product_code]"></td>
                                                    <td><input type="text" name="product[${investDetails}][fg_code]"></td>
                                                    <td><input type="text" name="product[${investDetails}][country]"></td>
                                                    <td><input type="text" name="product[${investDetails}][brand_name_grade]"></td>
                                                    <td><input type="text" name="product[${investDetails}][pack_size]"></td>
                                                    <td><input type="text" name="product[${investDetails}][shelf_life]"></td>
                                                    <td><input type="text" name="product[${investDetails}][sample_quantity]"></td>
                                                    <td><input type="text" name="product[${investDetails}][storage_condition]"></td>
                                                    <td><input type="text" name="product[${investDetails}][prepared_by_quality_person]"></td>
                                                    <td><input type="text" name="product[${investDetails}][checked_by_qc_hod_designee]"></td>
                                                    <td><input type="text" name="product[${investDetails}][approved_by_qa_hod_designee]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>`;
                                            }

                                            let tableBody = $('#productDetailsTable tbody');
                                            let rowCount = tableBody.children('tr').length;
                                            let newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                            investDetails++; // Increment row index
                                        });

                                        // Remove row event
                                        $(document).on('click', '.removeRowBtn', function () {
                                            $(this).closest('tr').remove();
                                        });
                                    });
                                </script>

                            <div class="group-input">
                                    <label for="action-plan-grid">
                                    Raw Material specification use below table<button type="button" name="action-plan-grid"
                                                id="RowMaterialData">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Row Increment
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="RowMaterialTable">
                                            <thead>
                                                <tr>
                                                    <th style="width: 2%">Sr.No</th>
                                                    <th style="width: 2%">Item Code</th>
                                                    <th style="width: 2%">Vendor Name</th>
                                                    <th style="width: 2%">Grade</th>
                                                    <th style="width: 2%">Sample quantity</th>
                                                    <th style="width: 2%">Storage condition</th>
                                                    <th style="width: 2%">Prepared by Quality Person (Sign/Date)</th>
                                                    <th style="width: 2%">Checked by QC (HOD/Designee) (Sign/Date)</th>
                                                    <th style="width: 2%">Approved by QA (HOD/Designee) (Sign/Date)</th>

                                                    <th style="width: 3%">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" style="width:15px" value="1"></td>
                                                    <td><input type="text" name="row_material[0][item_code]"></td>
                                                    <td><input type="text" name="row_material[0][vendor_name]"></td>
                                                    <td><input type="text" name="row_material[0][grade]"></td>
                                                    <td><input type="text" name="row_material[0][sample_quantity]"></td>
                                                    <td><input type="text" name="row_material[0][storage_condition]"></td>
                                                    <td><input type="text" name="row_material[0][prepared_quality_person_sign_date]"></td>
                                                    <td><input type="text" name="row_material[0][check_by_qc_hod_designee_sign]"></td>
                                                    <td><input type="text" name="row_material[0][approved_by_qa_hod_desinee_sign]"></td>

                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                     </div>
                                </div>



                                <script>
                                    $(document).ready(function () {
                                        let investDetails = 1; // Row counter

                                        $('#RowMaterialData').click(function () {
                                            function generateTableRow(serialNumber) {
                                                return `<tr>
                                                    <td><input disabled type="text" style="width:15px" value="${serialNumber}"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][item_code]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][vendor_name]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][grade]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][sample_quantity]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][storage_condition]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][prepared_quality_person_sign_date]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][check_by_qc_hod_designee_sign]"></td>
                                                    <td><input type="text" name="row_material[${investDetails}][approved_by_qa_hod_desinee_sign]"></td>

                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>`;
                                            }

                                            let tableBody = $('#RowMaterialTable tbody');
                                            let rowCount = tableBody.children('tr').length;
                                            let newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                            investDetails++; // Increment row index
                                        });

                                        // Remove row event
                                        $(document).on('click', '.removeRowBtn', function () {
                                            $(this).closest('tr').remove();
                                        });
                                    });
                                </script>


                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>


                    <!-- TDS Tabs -->
                    <div id="doc-tds" class="tabcontent">
                        <div class="orig-head">
                            TEST  DATA SHEET
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="comments">Product/Material Name</label>
                                        <input type="text" name="product_material_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="comments">TDS Type</label>
                                        <select name="tds_name_code" id="">
                                            <option value="">Select here</option>
                                            <option value="FP">Finished Product</option>
                                            <option value="IP">Inprocess Product</option>
                                            <option value="CV">Cleaning Validation</option>
                                            <option value="RW">Raw Material</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">Reference Standard/General Testing Procédure No</label>
                                        <input type="text" name="Reference_Standard">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">Total no. of pages in report</label>
                                        <input type="text" name="total_no_pages">
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">Mfg. Date</label>
                                        <input type="date" name="mfg_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">Exp. Date</label>
                                        <input type="date" name="exp_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">Analysis start date</label>
                                        <input type="date" name="analysis_start_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">Analysis completion date </label>
                                        <input type="date" name="analysis_completion_date ">
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">Specification No</label>
                                        <input type="text" name="specification_no">
                                    </div>
                                </div>


                                <div class="col-12 sub-head">
                                  A) Summary of Results:-

                                {{-- <div class="group-input">
                                    <label for="audit-agenda-grid">
                                        <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                        <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr No.</th>
                                                    <th>Test </th>
                                                    <th>Result</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="summaryResult[0][serial]" value="1"></td>
                                                    <td><input type="text" name="summaryResult[0][test]"></td>
                                                    <td><input type="text" name="summaryResult[0][result]"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> --}}


                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="tds_result" class="summernote"></textarea>
                                    </div>
                                </div>
                            </div>
                   

                            <div class="col-12 sub-head">
                             B) Test wise data and calculation:-
                                <div class="group-input">
                                    <label for="procedure"></label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea name="tds_test_wise" class="summernote"></textarea>
                                </div>
                            </div>

                            <div class="orig-head">
                               SAMPLE RECONCILATION
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="name_of_material/sample">Name of Material/Sample</label>
                                    <input type="text" name="name_of_material_sample">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="name_of_material/sample">Batch No.</label>
                                    <input type="text" name="sample_reconcilation_batchNo">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="name_of_material/sample">A.R.No.</label>
                                    <input type="text" name="sample_reconcilation_arNo">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="name_of_material/sample">Total Quantity Received</label>
                                    <input type="text" name="sample_quatity_received">
                                </div>
                            </div>

                                <div class="col-12 sub-head">
                                        Sample Reconcilation
                                </div>
                                    <div class="group-input">
                                        <label for="audit-agenda-grid">
                                            <button type="button" name="audit-agenda-grid" id="ObservationSample">+</button>
                                            <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="job-ObservationSample-table" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;">Sr No.</th>
                                                        <th>Test Name</th>
                                                        <th>Quantity Required for test as per STP</th>
                                                        <th>Quantity Used for test</th>
                                                        <th>Used by (Sign/Date)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text" name="sampleReconcilation[0][serial]" value="1"></td>
                                                        <td><input type="text" name="sampleReconcilation[0][test_name]"></td>
                                                        <td><input type="text" name="sampleReconcilation[0][quantity_test_stp]"></td>
                                                        <td><input type="text" name="sampleReconcilation[0][quantity_userd_test]"></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('#ObservationSample').click(function(e) {
                                                function generateTableRow(serialNumber) {
                                                    var html =
                                                        '<tr>' +
                                                        '<td><input disabled type="text" name="sampleReconcilation[' + serialNumber +
                                                        '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                        '<td><input type="text" name="sampleReconcilation[' + serialNumber +
                                                        '][test_name]"></td>' +
                                                        '<td><input type="text" name="sampleReconcilation[' + serialNumber +
                                                        '][quantity_test_stp]"></td>' +
                                                        '<td><input type="text" name="sampleReconcilation[' + serialNumber +
                                                        '][quantity_userd_test]"></td>' +
                                                        '<td></td>' +
                                                        '</tr>';
                                                    return html;
                                                }

                                                var tableBody = $('#job-ObservationSample-table tbody');
                                                var lastIndex = 0;

                                                // Check last row index from existing rows
                                                tableBody.find('tr').each(function() {
                                                    var inputName = $(this).find('input[name^="sampleReconcilation["]').attr('name');
                                                    var match = inputName.match(/\[(\d+)\]/);  // Extracting numeric index
                                                    if (match) {
                                                        var index = parseInt(match[1]);
                                                        if (index > lastIndex) {
                                                            lastIndex = index; // Set highest index
                                                        }
                                                    }
                                                });

                                                var newRow = generateTableRow(lastIndex + 1); // Increment highest index
                                                tableBody.append(newRow);
                                            });
                                        });
                                    </script>

                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="name_of_material/sample">Total Quantity Consumed</label>
                                        <input type="text" name="total_quantity_consumed">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="name_of_material/sample">Balance Quantity</label>
                                        <input type="text" name="balance_quantity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">Balance Quantity Destructed</label>
                                        <select name="balance_quantity_destructed" >
                                            <option value="">Enter your Selection</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div> --}}



                                    <div class="col-12 sub-head">
                                    Revision History:-

                                        <div class="group-input">
                                            <label for="audit-agenda-grid">
                                                <button type="button" name="audit-agenda-grid" id="ObservationAdd">+</button>
                                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#observation-field-instruction-modal" style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                    
                                                </span>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="job-responsibilty-table" style="width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:5%">Sr. No.</th>
                                                            <th class="">Revision No.</th>
                                                            <th class="">Change Control No./ DCRF No</th>
                                                            <th class="">Effective Date</th>
                                                            <th class="">Reason of revision</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><input disabled type="text" name="summaryResult[0][serial]" value="1"></td>
                                                            <td><input type="text" name="summaryResult[0][revision_no_tds]"></td>
                                                            <td><input type="text" name="summaryResult[0][changContNo_tds]"></td>
                                                            <td><input type="date" name="summaryResult[0][effectiveDate_tds]"></td>
                                                            <td><input type="text" name="summaryResult[0][reasonRevi_tds]"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            <script>
                                $(document).ready(function() {
                                    $('#ObservationAdd').click(function() {
                                        var tableBody = $('#job-responsibilty-table tbody');
                                        var lastRow = tableBody.find('tr:last');
                                        var lastIndex = lastRow.length ? parseInt(lastRow.find('input[name^="summaryResult["]').attr('name').match(/\[(\d+)\]/)[1]) : 0;

                                        function generateTableRow(serialNumber) {
                                            return `
                                                <tr>
                                                    <td><input disabled type="text" name="summaryResult[${serialNumber}][serial]" value="${serialNumber + 1}"></td>
                                                    <td><input type="text" name="summaryResult[${serialNumber}][revision_no_tds]"></td>
                                                    <td><input type="text" name="summaryResult[${serialNumber}][changContNo_tds]"></td>
                                                    <td><input type="date" name="summaryResult[${serialNumber}][effectiveDate_tds]"></td>
                                                    <td><input type="text" name="summaryResult[${serialNumber}][reasonRevi_tds]"></td>
                                                </tr>`;
                                        }

                                        var newRow = generateTableRow(lastIndex + 1);
                                        tableBody.append(newRow);
                                    });
                                });
                            </script>

                            </div>

                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>



                    {{-- hold study report tabs  --}}

                <div id="doc-holdtimstduy" class="tabcontent">
                    <div class="orig-head">
                        Hold Time Study Report
                    </div>
                    <div class="input-fields">
                        <div class="row">
                    {{--
                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Purpose_HoTiStRe" id="Purpose_HoTiStRe">
                                        Purpose<button type="button" id="Purpose_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Purpose_HoTiStRediv">
                                        <div class="singlePurpose_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Purpose_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subPurpose_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Scope_HoTiStRe" id="Scope_HoTiStRe">
                                        Scope<button type="button" id="Scope_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Scope_HoTiStRediv">
                                        <div class="singleScope_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Scope_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subScope_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="BatchDetails_HoTiStRe" id="BatchDetails_HoTiStRe">
                                        Batch Details<button type="button" id="BatchDetails_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="BatchDetails_HoTiStRediv">
                                        <div class="singleBatchDetails_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="BatchDetails_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subBatchDetails_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ReferenceDocument_HoTiStRe" id="ReferenceDocument_HoTiStRe">
                                        Reference Document<button type="button" id="ReferenceDocument_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ReferenceDocument_HoTiStRediv">
                                        <div class="singleReferenceDocument_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ReferenceDocument_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subReferenceDocument_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Quality Control">
                                        CALIBRATION AND QUALIFICATION STATUS
                                        <button type="button" name="add_quality_control_1"
                                            id="add_calibrationandqualifc">+</button>
                                    </label>
                                    <table class="table table-bordered" id="calibrationandqualifc_details">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Equipment Name</th>
                                                <th>Location</th>
                                                <th>Equipment No</th>
                                                <th>Qualification Status</th>
                                                <th>Valid Upto</th>
                                                <th>Remark</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Default first row -->
                                            <tr>
                                                <td><input disabled type="text" name="qualitycontrol_1[0][serial]"
                                                        value="1"></td>
                                                <td><input type="text" name="qualitycontrol_1[0][Equipment_Name]"></td>
                                                <td><input type="text" name="qualitycontrol_1[0][Location]">
                                                </td>
                                                <td><input type="text"
                                                        name="qualitycontrol_1[0][Equipment_No]"></td>
                                                <td><input type="text" name="qualitycontrol_1[0][Qualification_Status]">
                                                </td>
                                                <td><input type="text" name="qualitycontrol_1[0][Valid_Upto]"></td>
                                                <td><input type="text" name="qualitycontrol_1[0][remark]"></td>
                                                </td>
                                                <td><button type="button" class="removeRowBtn">Remove</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    // Add new row in Quality Control 1 table
                                    $('#add_calibrationandqualifc').click(function(e) {
                                        e.preventDefault();

                                        function generateQualityTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="qualitycontrol_1[' + serialNumber +
                                                '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="qualitycontrol_1[' + serialNumber + '][Equipment_Name]"></td>' +
                                                '<td><input type="text" name="qualitycontrol_1[' + serialNumber +
                                                '][Location]"></td>' +
                                                '<td><input type="text" name="qualitycontrol_1[' + serialNumber +
                                                '][Equipment_No]"></td>' +
                                                '<td><input type="text" name="qualitycontrol_1[' + serialNumber +
                                                '][Qualification_Status]"></td>' +
                                                '<td><input type="text" name="qualitycontrol_1[' + serialNumber +
                                                '][Valid_Upto]"></td>' +
                                                '<td><input type="text" name="qualitycontrol_1[' + serialNumber +
                                                '][remark]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#calibrationandqualifc_details tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateQualityTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    // Remove row in Quality Control 1 table
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script>


                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ResultBulkStage_HoTiStRe" id="ResultBulkStage_HoTiStRe">
                                        Results of Bulk Stage<button type="button" id="ResultBulkStage_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ResultBulkStage_HoTiStRediv">
                                        <div class="singleResultBulkStage_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ResultBulkStage_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subResultBulkStage_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="DeviationIfAny_HoTiStRe" id="DeviationIfAny_HoTiStRe">
                                        Deviation If Any <button type="button" id="DeviationIfAny_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="DeviationIfAny_HoTiStRediv">
                                        <div class="singleDeviationIfAny_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="DeviationIfAny_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subDeviationIfAny_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Summary_HoTiStRe" id="Summary_HoTiStRe">
                                        Summary<button type="button" id="Summary_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Summary_HoTiStRediv">
                                        <div class="singleSummary_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Summary_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subSummary_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="Conclusion_HoTiStRe" id="Conclusion_HoTiStRe">
                                        Conclusion <button type="button" id="Conclusion_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="Conclusion_HoTiStRediv">
                                        <div class="singleConclusion_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="Conclusion_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subConclusion_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="group-input">

                                    <label for="ReportApproval_HoTiStRe" id="ReportApproval_HoTiStRe">
                                        Report Approval <button type="button" id="ReportApproval_HoTiStRebtnadd"
                                            name="button">+</button>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                                does not require completion</small></div>
                                    </label>

                                    <div id="ReportApproval_HoTiStRediv">
                                        <div class="singleReportApproval_HoTiStReBlock">
                                            <div class="row">
                                                <div class="col-sm-10">
                                                    <textarea name="ReportApproval_HoTiStRe[]" class="myclassname"></textarea>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-dark subReportApproval_HoTiStReAdd">+</button>
                                                </div>
                                                <div class="col-sm-1">
                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> --}}

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Hold Time Study Report Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="HolTimSutRep_fileattachement"></div>

                                        <div class="add-btn">
                                            <label for="HolTimSutRep_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                            <input type="file" id="HolTimSutRep_I_gxp_attachment" name="HolTimSutRepfile_attach[]"
                                                oninput="addMultipleFiles(this, 'HolTimSutRep_fileattachement')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>
                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>



                {{-- bill  of material tabs --}}

                <div id="doc-billofmaterial" class="tabcontent">
                    <div class="orig-head">
                        Bill of Materia                    
                    </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Bill of Materia  File Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="billMatrial"></div>

                                        <div class="add-btn">
                                            <label for="billMatrial_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                            <input type="file" id="billMatrial_I_gxp_attachment" name="billMatrial[]"
                                                oninput="addMultipleFiles(this, 'billMatrial')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>





                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>


                {{-- Master formula record tabs   of material tabs --}}

                <div id="doc-masterformulaRecord" class="tabcontent">
                    <div class="orig-head">
                        Master Formula Record (MFR)                    
                    </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Master Formula Record  File Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="MasterFormulaRecordBMR"></div>

                                        <div class="add-btn">
                                            <label for="MasterFormulaRecordBMR_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                            <input type="file" id="MasterFormulaRecordBMR_I_gxp_attachment" name="MasterFormulaRecordBMR[]"
                                                oninput="addMultipleFiles(this, 'MasterFormulaRecordBMR')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>





                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>


                  {{-- Master Packing record tabs   of material tabs --}}

                  <div id="doc-masterPackingRecord" class="tabcontent">
                    <div class="orig-head">
                        Master Packing Record (MFR)                    
                    </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Master Packing Record  File Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="MasterPackingRecord"></div>

                                        <div class="add-btn">
                                            <label for="MasterPackingRecord_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                            <input type="file" id="MasterPackingRecord_I_gxp_attachment" name="MasterPackingRecord[]"
                                                oninput="addMultipleFiles(this, 'MasterPackingRecord')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>





                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>


                 {{-- Site master  tabs   of material tabs --}}

                 <div id="doc-SiteMasterFile" class="tabcontent">
                    <div class="orig-head">
                        Site Master File                    
                    </div>
                    <div class="input-fields">
                        <div class="row">

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="File_Attachment"><b>Site Master Attachment</b></label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="SiteMasterFileatt"></div>

                                        <div class="add-btn">
                                            <label for="SiteMasterFileatt_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                            <input type="file" id="SiteMasterFileatt_I_gxp_attachment" name="SiteMasterFileatt[]"
                                                oninput="addMultipleFiles(this, 'SiteMasterFileatt')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>





                        </div>
                    </div>
                    <div class="button-block">
                        <button type="submit" value="save" name="submit" id="DocsaveButton"
                            class="saveButton">Save</button>
                        <button type="button" class="backButton" onclick="previousStep()">Back</button>
                        <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                            </a>
                        </button>
                    </div>
                </div>



                {{-- batch maniufacring  tabs --}}

                    <div id="doc-manufacturingRecord" class="tabcontent">
                        <div class="orig-head">
                            Batch Manufacturing Record (BMR)                    
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="File_Attachment"><b>Batch Manufacturing Record (BMR)  File Attachment</b></label>
                                        <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="batchManufacturingBmr"></div>

                                            <div class="add-btn">
                                                <label for="batchManufacturingBmr_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                                <input type="file" id="batchManufacturingBmr_I_gxp_attachment" name="batchManufacturingBmr[]"
                                                    oninput="addMultipleFiles(this, 'batchManufacturingBmr')" multiple hidden>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                function addMultipleFiles(input, listId) {
                                    let fileList = document.getElementById(listId);
                                    fileList.innerHTML = ""; // Clear previous files (if needed)

                                    for (let file of input.files) {
                                        let fileItem = document.createElement("div");
                                        fileItem.textContent = file.name;
                                        fileList.appendChild(fileItem);
                                    }
                                }
                                </script>





                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>



                    {{-- Finished product,  Inprocess , Cleaning Validation Specification (Commercial  registration , re-registration) tabs --}}

                    <div id="doc_FPS" class="tabcontent">
                        <div class="orig-head">Finished Product Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Product Name</label>
                                        <input type="text" name="fsproduct_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Generic Name</label>
                                        <input type="text" name="generic_name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="brand-name">Brand Name</label>
                                        <input type="text" name="brand_name">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Label Claim</label>
                                        <input type="text" name="label_claim">
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                     Label Claim
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="label_claim" class="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="product-code">Product Code</label>
                                        <input type="text" name="product_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="storage-condition">Storage Condition</label>
                                        <input type="text" name="fsstorage_condition">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity">
                                            <option value="" selected>Enter your Selection</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>

                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                    Sample Quantity for Analysis
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="sample_quantity" class="summernote"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reserve-sample">Reserve Sample Quantity</label>
                                        <input type="text" name="reserve_sample">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="custom-sample">Custom Sample</label>
                                        <input type="text" name="custom_sample">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Reference</label>
                                        <input type="text" name="reference">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sampling-instructions">Sampling Instructions, Warnings, and Precautions</label>
                                        <input type="text" name="sampling_instructions">
                                    </div>
                                </div>


                                <div class="col-12 sub-head">
                                    SPECIFICATION
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="fps_specificationGrid" class="summernote"></textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Specification Details">
                                            Specification Details
                                            <button type="button" id="specification_add">+</button>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="specification_details" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%; text-align: center; border: 1px solid black;" rowspan="2">Sr. No</th>
                                                    <th style="width: 20%; text-align: center; border: 1px solid black;" rowspan="2">Tests</th>
                                                    <th style="width: 50%; text-align: center; border: 1px solid black;" colspan="2">Specifications</th>
                                                    <th style="width: 20%; text-align: center; border: 1px solid black;" rowspan="2">Reference</th>
                                                    <th style="width: 10%; text-align: center; border: 1px solid black;" rowspan="2">Action</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%; text-align: center; border: 1px solid black;">Release</th>
                                                    <th style="width: 25%; text-align: center; border: 1px solid black;">Shelf Life</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <!-- Initial Row Placeholder (Optional) -->
                                                    <tr>
                                                        <td><input disabled type="text" name="specification_details[0][serial]" value="1"></td>
                                                        <td><input type="text" name="specification_details[0][test]"></td>
                                                        <td><input type="text" name="specification_details[0][release]"></td>
                                                        <td><input type="text" name="specification_details[0][shelf_life]"></td>
                                                        <td><input type="text" name="specification_details[0][reference]"></td>
                                                        <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}
                                <script>
                                    $(document).ready(function() {
                                        // Add new row in Specification Details table
                                        $('#specification_add').click(function(e) {
                                            e.preventDefault();

                                            function generateSpecificationTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="specification_details[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="specification_details[' + serialNumber + '][test]"></td>' +
                                                    '<td><input type="text" name="specification_details[' + serialNumber + '][release]"></td>' +
                                                    '<td><input type="text" name="specification_details[' + serialNumber + '][shelf_life]"></td>' +
                                                    '<td><input type="text" name="specification_details[' + serialNumber + '][reference]"></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#specification_details tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateSpecificationTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });

                                        // Remove row in Specification Details table
                                        $(document).on('click', '.removeRowBtn', function() {
                                            $(this).closest('tr').remove();
                                        });
                                    });
                                </script>
                            {{-- <div class="col-12 sub-head">
                                Validation  Specification
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        Specification Validation Details
                                        <button type="button" id="specification_validation_add">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="specification_validation_details" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Specification</th>
                                                    <th>Reference</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Initial Row Placeholder (Optional) -->
                                                <tr>
                                                    <td><input disabled type="text" name="specification_validation_details[0][serial]" value="1"></td>
                                                    <td><input type="text" name="specification_validation_details[0][test]"></td>
                                                    <td><input type="text" name="specification_validation_details[0][specification]"></td>
                                                    <td><input type="text" name="specification_validation_details[0][reference]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <script>
                                $(document).ready(function() {
                                    // Add new row in Specification Details table
                                    $('#specification_validation_add').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="specification_validation_details[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="specification_validation_details[' + serialNumber + '][test]"></td>' +
                                                '<td><input type="text" name="specification_validation_details[' + serialNumber + '][specification]"></td>' +
                                                '<td><input type="text" name="specification_validation_details[' + serialNumber + '][reference]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#specification_validation_details tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    // Remove row in Specification Details table
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script> --}}

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

            <!-- Cleaning Validation Specification -->

                <div id="doc_CVS" class="tabcontent">
                        <div class="orig-head">CLEANING VALIDATION SPECIFICATION
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Product Name</label>
                                        <input type="text" name="product_name_cvs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Generic Name</label>
                                        <input type="text" name="generic_name_cvs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="brand-name">Brand Name</label>
                                        <input type="text" name="brand_name_cvs">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Label Claim</label>
                                        <input type="text" name="label_claim_cvs">
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                     Label Claim
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="label_claim_cvs" class="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="product-code">Product Code</label>
                                        <input type="text" name="product_code_cvs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="storage-condition">Storage Condition</label>
                                        <input type="text" name="storage_condition_cvs">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity_cvs">
                                            <option value="" selected>Enter your Selection</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>

                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                       Sample Quantity for Analysis
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="sample_quantity_cvs" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reserve-sample">Reserve Sample Quantity</label>
                                        <input type="text" name="reserve_sample_cvs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="custom-sample">Custom Sample</label>
                                        <input type="text" name="custom_sample_cvs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Reference</label>
                                        <input type="text" name="reference_cvs">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sampling-instructions">Sampling Instructions, Warnings, and Precautions</label>
                                        <input type="text" name="sampling_instructions_cvs">
                                    </div>
                                </div>

                            {{-- <div class="col-12 sub-head">
                                    SPECIFICATION
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Specification Details">
                                            Specification Details
                                            <button type="button" id="specification_add_cvs">+</button>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="specification_details_cvs" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%; text-align: center; border: 1px solid black;" rowspan="2">Sr. No</th>
                                                    <th style="width: 20%; text-align: center; border: 1px solid black;" rowspan="2">Tests</th>
                                                    <th style="width: 50%; text-align: center; border: 1px solid black;" colspan="2">Specifications</th>
                                                    <th style="width: 20%; text-align: center; border: 1px solid black;" rowspan="2">Reference</th>
                                                    <th style="width: 10%; text-align: center; border: 1px solid black;" rowspan="2">Action</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%; text-align: center; border: 1px solid black;">Release</th>
                                                    <th style="width: 25%; text-align: center; border: 1px solid black;">Shelf Life</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text" name="specification_details_cvs[0][serial]" value="1"></td>
                                                        <td><input type="text" name="specification_details_cvs[0][test]"></td>
                                                        <td><input type="text" name="specification_details_cvs[0][release]"></td>
                                                        <td><input type="text" name="specification_details_cvs[0][shelf_life]"></td>
                                                        <td><input type="text" name="specification_details_cvs[0][reference]"></td>
                                                        <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        // Add new row in Specification Details table
                                        $('#specification_add_cvs').click(function(e) {
                                            e.preventDefault();

                                            function generateSpecificationTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="specification_details_cvs[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="specification_details_cvs[' + serialNumber + '][test]"></td>' +
                                                    '<td><input type="text" name="specification_details_cvs[' + serialNumber + '][release]"></td>' +
                                                    '<td><input type="text" name="specification_details_cvs[' + serialNumber + '][shelf_life]"></td>' +
                                                    '<td><input type="text" name="specification_details_cvs[' + serialNumber + '][reference]"></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#specification_details_cvs tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateSpecificationTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });

                                        // Remove row in Specification Details table
                                        $(document).on('click', '.removeRowBtn', function() {
                                            $(this).closest('tr').remove();
                                        });
                                    });
                                </script> --}}




                            <div class="col-12 sub-head">
                                 Specification
                                <div class="group-input">
                                    <label for="procedure"></label>
                                    <textarea name="cvs_specificationGrid" class="summernote"></textarea>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        Specification Validation Details
                                        <button type="button" id="specification_validation_add_cvs">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="specification_validation_details_cvs" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Specification</th>
                                                    <th>Reference</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Initial Row Placeholder (Optional) -->
                                                <tr>
                                                    <td><input disabled type="text" name="specification_validation_details_cvs[0][serial]" value="1"></td>
                                                    <td><input type="text" name="specification_validation_details_cvs[0][test]"></td>
                                                    <td><input type="text" name="specification_validation_details_cvs[0][specification]"></td>
                                                    <td><input type="text" name="specification_validation_details_cvs[0][reference]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}


                            <script>
                                $(document).ready(function() {
                                    // Add new row in Specification Details table
                                    $('#specification_validation_add_cvs').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="specification_validation_details_cvs[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="specification_validation_details_cvs[' + serialNumber + '][test]"></td>' +
                                                '<td><input type="text" name="specification_validation_details_cvs[' + serialNumber + '][specification]"></td>' +
                                                '<td><input type="text" name="specification_validation_details_cvs[' + serialNumber + '][reference]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#specification_validation_details_cvs tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    // Remove row in Specification Details table
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                </div>


               <!-- Inprocess Validation Specification -->
                <div id="doc_INPS" class="tabcontent">
                        <div class="orig-head">INPROCESS VALIDATION SPECIFICATION
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Product Name</label>
                                        <input type="text" name="product_name_inps">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Generic Name</label>
                                        <input type="text" name="generic_name_inps">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="brand-name">Brand Name</label>
                                        <input type="text" name="brand_name_inps">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Label Claim</label>
                                        <input type="text" name="label_claim_inps">
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                     Label Claim
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="label_claim_inps" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="product-code">Product Code</label>
                                        <input type="text" name="product_code_inps">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="storage-condition">Storage Condition</label>
                                        <input type="text" name="storage_condition_inps">
                                    </div>
                                </div>


                                <div class="col-12 sub-head">
                                      Sample Quantity for Analysis
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="sample_quantity_inps" class="summernote"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reserve-sample">Reserve Sample Quantity</label>
                                        <input type="text" name="reserve_sample_inps">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="custom-sample">Custom Sample</label>
                                        <input type="text" name="custom_sample_inps">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Reference</label>
                                        <input type="text" name="reference_inps">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sampling-instructions">Sampling Instructions, Warnings, and Precautions</label>
                                        <input type="text" name="sampling_instructions_inps">
                                    </div>
                                </div>

                            {{-- <div class="col-12 sub-head">
                                    SPECIFICATION
                                </div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Specification Details">
                                            Specification Details
                                            <button type="button" id="specification_add_inps">+</button>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="specification_details_inps" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10%; text-align: center; border: 1px solid black;" rowspan="2">Sr. No</th>
                                                    <th style="width: 20%; text-align: center; border: 1px solid black;" rowspan="2">Tests</th>
                                                    <th style="width: 50%; text-align: center; border: 1px solid black;" colspan="2">Specifications</th>
                                                    <th style="width: 20%; text-align: center; border: 1px solid black;" rowspan="2">Reference</th>
                                                    <th style="width: 10%; text-align: center; border: 1px solid black;" rowspan="2">Action</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 25%; text-align: center; border: 1px solid black;">Release</th>
                                                    <th style="width: 25%; text-align: center; border: 1px solid black;">Shelf Life</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                    <!-- Initial Row Placeholder (Optional) -->
                                                    <tr>
                                                        <td><input disabled type="text" name="specification_details_inps[0][serial]" value="1"></td>
                                                        <td><input type="text" name="specification_details_inps[0][test]"></td>
                                                        <td><input type="text" name="specification_details_inps[0][release]"></td>
                                                        <td><input type="text" name="specification_details_inps[0][shelf_life]"></td>
                                                        <td><input type="text" name="specification_details_inps[0][reference]"></td>
                                                        <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        // Add new row in Specification Details table
                                        $('#specification_add_inps').click(function(e) {
                                            e.preventDefault();

                                            function generateSpecificationTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="specification_details_inps[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="specification_details_inps[' + serialNumber + '][test]"></td>' +
                                                    '<td><input type="text" name="specification_details_inps[' + serialNumber + '][release]"></td>' +
                                                    '<td><input type="text" name="specification_details_inps[' + serialNumber + '][shelf_life]"></td>' +
                                                    '<td><input type="text" name="specification_details_inps[' + serialNumber + '][reference]"></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#specification_details_inps tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateSpecificationTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });

                                        // Remove row in Specification Details table
                                        $(document).on('click', '.removeRowBtn', function() {
                                            $(this).closest('tr').remove();
                                        });
                                    });
                            </script> --}}


                            <div class="col-12 sub-head">
                                     Specification
                                <div class="group-input">
                                    <label for="procedure"></label>
                                    <textarea name="ips_specificationGrid" class="summernote"></textarea>
                                </div>
                            </div>
                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        Specification Validation Details
                                        <button type="button" id="specification_validation_add_inps">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="specification_validation_details_inps" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Specification</th>
                                                    <th>Reference</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Initial Row Placeholder (Optional) -->
                                                <tr>
                                                    <td><input disabled type="text" name="specification_validation_details_inps[0][serial]" value="1"></td>
                                                    <td><input type="text" name="specification_validation_details_inps[0][test]"></td>
                                                    <td><input type="text" name="specification_validation_details_inps[0][specification]"></td>
                                                    <td><input type="text" name="specification_validation_details_inps[0][reference]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            <script>
                                $(document).ready(function() {
                                    // Add new row in Specification Details table
                                    $('#specification_validation_add_inps').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="specification_validation_details_inps[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="specification_validation_details_inps[' + serialNumber + '][test]"></td>' +
                                                '<td><input type="text" name="specification_validation_details_inps[' + serialNumber + '][specification]"></td>' +
                                                '<td><input type="text" name="specification_validation_details_inps[' + serialNumber + '][reference]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#specification_validation_details_inps tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    // Remove row in Specification Details table
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script>

                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                </div>


                <!--Process Validation Protocol Interim  -->
                <div id="doc_proc_interim" class="tabcontent">
                    <div class="orig-head">
                        PROCESS VALIDATION INTERIM REPORT
                        </div>
                        <div class="input-fields">

                            {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Dosage Form</label>
                                        <input type="text" name="pvir_dosage_form">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Process Validation Interim Report</label>
                                        <input type="text" name="pvir_process_validation_interim_report">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Product Name</label>
                                        <input type="text" name="pvir_product_name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Report No</label>
                                        <input type="number" name="pvir_report_no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Batch No</label>
                                        <input type="number" name="pvir_batch_no">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="purpose">Generic Name </label>
                                        <input type="text" name="generic_pvir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Product Code</label>
                                        <input type="number" name="pvir_product_code">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Std. Batch size </label>
                                        <input type="number" name="pvir_std_batch">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Category</label>
                                        <input type="text" name="pvir_category">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Label Claim  </label>
                                        <input type="text" name="pvir_label_claim">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Market</label>
                                        <input type="text" name="pvir_market">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">Shelf Life</label>
                                        <input type="text" name="pvir_shelf_life">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">BMR No.</label>
                                        <input type="number" name="pvir_bmr_no">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="scope">MFR No.</label>
                                        <input type="number" name="pvir_mfr_no">
                                    </div>
                                </div>



                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Critical_Process_Parameters" id="Critical_quality_attributes">
                                            Critical process parameters & Critical quality attributes<button type="button" id="Critical_quality_pvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="critical_quality_pvirpdiv">
                                            <div class="singleCriticalPvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="critical_pvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subcritical_quality_pvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Results of In process data" id="result_In_process_data">
                                            Results of In process data<button type="button" id="In_process_data_pvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="In_process_data_pvirdiv">
                                            <div class="single_In_process_data_PvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="In_process_data_pvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subIn_process_data_pvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Yield at various stages" id="Various_stages">
                                            % Yield at various stages<button type="button" id="various_stages_pvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="various_stages_pvirdiv">
                                            <div class="singlevarious_stages_PvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="various_stages_pvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subvarious_stages_pvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="deviation" id="deviation_if_any">
                                            Deviation (If any)
                                            <button type="button" id="deviation_pvirbtnadd" name="button">+</button>
                                            <div>
                                                <small class="text-primary">Please insert "NA" in the data field if it does not require completion</small>
                                            </div>
                                        </label>
                                        <div id="deviation_pvirdiv">
                                            <div class="singleDeviationBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="deviation_pvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subdeviation_pvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Change Control ( If any)" id="change_control_if_any">
                                            Change Control ( If any)<button type="button" id="change_controlpvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="change_controlpvirdiv">
                                            <div class="singlechange_controlPvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="change_controlpvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark controlpvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger change_control_removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Summary" id="Summary">
                                            Summary<button type="button" id="Summarypvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="Summarypvirdiv">
                                            <div class="singleSummaryPvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="Summary_pvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subSummarypvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Conclusion" id="conclusion">
                                            Conclusion<button type="button" id="conclusionpvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="conclusion_pvirdiv">
                                            <div class="single_Conclusion_pvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="conclusion_pvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subConclusion_pvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="Report_Approval" id="report_approval">
                                            Report Approval<button type="button" id="report_approvalpvirbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>
                                        <div id="report_approvalpvirdiv">
                                            <div class="singlereport_approvalPvirBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="report_approvalpvir[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subreport_approvalpvirAdd">+</button>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment">File Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="pvir_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="pvir_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="pvir_attachment" name="pvir_attachment[]"
                                                        oninput="addMultipleFiles(this, 'pvir_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>


               <!-- Annexure I-Gxp Assessment start  -->
                <div id="doc_Annexure_I" class="tabcontent">
                    <div class="orig-head">
                        Annexure I-Gxp Assessment
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_I_gxp_attachment" name="annex_I_gxp_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure I-Gxp Assessment end  -->

               <!-- Annexure II-Initial Risk Assessment start -->
                <div id="doc_Annexure_II" class="tabcontent">
                    <div class="orig-head">
                        Annexure II-Initial Risk Assessment
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annexIIRisk_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_II_risk_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_II_risk_attachment" name="annex_II_risk_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annexIIRisk_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure II-Initial Risk Assessment end -->

               <!-- Annexure III-ERES Assessment start -->
                <div id="doc_Annexure_III" class="tabcontent">
                    <div class="orig-head">
                        Annexure III-ERES Assessment
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annexIIIeres_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_III_eres_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_III_eres_attachment" name="annex_III_eres_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annexIIIeres_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        function addMultipleFiles(input, listId) {
                                            let fileList = document.getElementById(listId);
                                            fileList.innerHTML = ""; // Clear previous files (if needed)

                                            for (let file of input.files) {
                                                let fileItem = document.createElement("div");
                                                fileItem.textContent = file.name;
                                                fileList.appendChild(fileItem);
                                            }
                                        }
                                    </script>



                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure III-ERES Assessment end -->

               <!-- Annexure IV-Validation Plan start -->
                <div id="doc_Annexure_IV" class="tabcontent">
                    <div class="orig-head">
                        Annexure IV-Validation Plan
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annexIVPlan_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_IV_plan_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_IV_plan_attachment" name="annex_IV_plan_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annexIVPlan_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                        function addMultipleFiles(input, listId) {
                                            let fileList = document.getElementById(listId);
                                            fileList.innerHTML = ""; // Clear previous files (if needed)

                                            for (let file of input.files) {
                                                let fileItem = document.createElement("div");
                                                fileItem.textContent = file.name;
                                                fileList.appendChild(fileItem);
                                            }
                                        }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure IV-ERES Assessment end -->

               <!-- Annexure V-User Requirements Specification -->
                <div id="doc_Annexure_V" class="tabcontent">
                    <div class="orig-head">
                        Annexure V-User Requirement Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annexVUser_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_V_user_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_V_user_attachment" name="annex_V_user_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annexVUser_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                        function addMultipleFiles(input, listId) {
                                            let fileList = document.getElementById(listId);
                                            fileList.innerHTML = ""; // Clear previous files (if needed)

                                            for (let file of input.files) {
                                                let fileItem = document.createElement("div");
                                                fileItem.textContent = file.name;
                                                fileList.appendChild(fileItem);
                                            }
                                        }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure V-ERES Assessment end -->

               <!-- Annexure VI-Functional Requirement Specification start  -->
                <div id="doc_Annexure_VI" class="tabcontent">
                    <div class="orig-head">
                        Annexure VI-Functional Requirement Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_VIreq_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_VI_req_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_VI_req_attachment" name="annex_VI_req_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_VIreq_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure VI-Functional Requirement Specification  -->

               <!-- Annexure VII-Functional Specification start -->
                <div id="doc_Annexure_VII" class="tabcontent">
                    <div class="orig-head">
                        Annexure VII-Functional Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_VII_fun_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_VII_fun_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_VII_fun_attachment" name="annex_VII_fun_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_VII_fun_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure VII-Functional Specification end -->

               <!-- Annexure VIII-Technical Specification start -->
                <div id="doc_Annexure_VIII" class="tabcontent">
                    <div class="orig-head">
                        Annexure VIII-Technical Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annexVIII_tech_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_VIII_tech_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_VIII_tech_attachment" name="annex_VIII_tech_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annexVIII_tech_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure VIII-Technical Specification end -->

               <!-- Annexure IX Functional Risk Assssment start -->
                <div id="doc_Annexure_IX" class="tabcontent">
                    <div class="orig-head">
                        Annexure IX Functional Risk Assssment
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_IX_risk_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_IX_risk_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_IX_risk_attachment" name="annex_IX_risk_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_IX_risk_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure IX Functional Risk Assssment end -->

               <!-- Annexure X-Design Specification start -->
                <div id="doc_Annexure_X" class="tabcontent">
                    <div class="orig-head">
                        Annexure X-Design Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_X_Design_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_X_design_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_X_design_attachment" name="annex_X_design_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_X_Design_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>

                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure X-Design Specification end -->


               <!-- Annexure XI-Configuration Specification start -->
               <div id="doc_Annexure_XI" class="tabcontent">
                    <div class="orig-head">
                        Annexure XI-Configuration Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_XI_Config_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_XI_confi_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_XI_confi_attachment" name="annex_XI_confi_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_XI_Config_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure XI-Configuration Specification end -->

            <!-- Annexure XII Installation Infrastructure Operational Performance Qualification Protocol start -->
                <div id="doc_Annexure_XII" class="tabcontent">
                    <div class="orig-head">
                        Annexure XII Installation Infrastructure Operational Performance Qualification Protocol
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                {{-- <div class="">
                                  PRODUCT DETAILS
                                </div>  <br> --}}

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_XII_quaProto_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_XII_qua_proto_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_XII_qua_proto_attachment" name="annex_XII_qua_proto_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_XII_quaProto_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure XII Installation Infrastructure Operational Performance Qualification Protocol end -->

                 <!-- Annexure XIII Unit Integration Test Script start -->
                <div id="doc_Annexure_XIII" class="tabcontent">
                    <div class="orig-head">
                        Annexure XIII Unit Integration Test Script
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                {{-- <div class="">
                                  PRODUCT DETAILS
                                </div>  <br> --}}

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_XIII_unitInteg_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_XIII_unit_integ_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_XIII_unit_integ_attachment" name="annex_XIII_unit_integ_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_XIII_unitInteg_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure XIII Unit Integration Test Script end -->

               <!-- Annexure XIV Data Migration Protocol start -->
                <div id="doc_Annexure_XIV" class="tabcontent">
                    <div class="orig-head">
                        Annexure XIV Data Migration Protocol
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                {{-- <div class="">
                                  PRODUCT DETAILS
                                </div>  <br> --}}

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_XIV_dataMigra_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_XIV_data_migra_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_XIV_data_migra_attachment" name="annex_XIV_data_migra_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_XIV_dataMigra_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>




                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure XIV Data Migration Protocol end -->

               <!-- Annexure XV Data Qualification Protocol start -->
                <div id="doc_Annexure_XV" class="tabcontent">
                    <div class="orig-head">
                        Annexure XV Data Qualification Protocol
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                {{-- <div class="">
                                  PRODUCT DETAILS
                                </div>  <br> --}}

                                   <div class="col-12">
                                        <div class="group-input">
                                            <label for="File_Attachment"><b>File Attachment</b></label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="annex_XV_dataQualif_fileattachement"></div>

                                                <div class="add-btn">
                                                    <label for="annex_XV_data_qualif_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_XV_data_qualif_attachment" name="annex_XV_data_qualif_attachment[]"
                                                        oninput="addMultipleFiles(this, 'annex_XV_dataQualif_fileattachement')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>


                                <div class="button-block">
                                    <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                        </a>
                                    </button>
                                </div>
                         </div>
                    </div>
                </div>
               <!-- Annexure XV Data Qualification Protocol end -->


                    {{-- Finished product,  Inprocess,  Cleaning Validation Standard Testing Procedure (Commercial  registration , re-registration) TABS --}}

                    <div id="doc-fpstp" class="tabcontent">
                        <div class="orig-head">
                          Finished Product Standard Testing Procedure
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Product Name</label>
                                        <input type="text" name="product_name_fpstp">
                                    </div>
                                </div>

                                <div class="col-12 sub-head">
                                    STANDARD TESTING PROCEDURE
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="fpstp_testfield" class="summernote"></textarea>
                                    </div>
                                </div>
                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        STANDARD TESTING PROCEDURE
                                        <button type="button" id="Standard_Testing_add_1">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Standard_Testing_detail_1" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="finished_product[0][serial]" value="1"></td>
                                                    <td><input type="text" name="finished_product[0][testing]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <script>
                                $(document).ready(function() {
                                    $('#Standard_Testing_add_1').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="finished_product[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="finished_product[' + serialNumber + '][testing]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#Standard_Testing_detail_1 tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    // Remove row in Specification Details table
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script> --}}
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-istp" class="tabcontent">
                        <div class="orig-head">
                            Inprocess Standard Testing Procedure
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Product Name</label>
                                        <input type="text" name="product_name_ipstp">
                                    </div>
                                </div>

                                <div class="col-12 sub-head">
                                    STANDARD TESTING PROCEDURE
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="ipstp_testfield" class="summernote"></textarea>
                                    </div>
                                </div>

                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        STANDARD TESTING PROCEDURE
                                        <button type="button" id="Standard_Testing_add_2">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Standard_Testing_details_2" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Initial Row Placeholder (Optional) -->
                                                <tr>
                                                    <td><input disabled type="text" name="inprocess_standard[0][serial]" value="1"></td>
                                                    <td><input type="text" name="inprocess_standard[0][testingdata]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#Standard_Testing_add_2').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="inprocess_standard[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="inprocess_standard[' + serialNumber + '][testingdata]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#Standard_Testing_details_2 tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script> --}}
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-cvstp" class="tabcontent">
                        <div class="orig-head">
                            Cleaning Validation Standard Testing Procedure
                        </div>
                        <div class="input-fields">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reference">Product Name</label>
                                        <input type="text" name="product_name_cvstp">
                                    </div>
                                </div>

                                <div class="col-12 sub-head">
                                    STANDARD TESTING PROCEDURE
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="cvstp_testfield" class="summernote"></textarea>
                                    </div>
                                </div>
                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        STANDARD TESTING PROCEDURE
                                        <button type="button" id="Standard_Testing_add_3">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Standard_Testing_details_3" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="cleaning_validation[0][serial]" value="1"></td>
                                                    <td><input type="text" name="cleaning_validation[0][data_test]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#Standard_Testing_add_3').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="cleaning_validation[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="cleaning_validation[' + serialNumber + '][data_test]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#Standard_Testing_details_3 tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script> --}}
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>



                    {{-- Rajendra code start here  --}}

                    <div id="doc-afqp" class="tabcontent">
                        <div class="orig-head">
                            Annexure For Qualification Protocol
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                              <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments"> Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachement_afqp"></div>

                                                <div class="add-btn">
                                                    <label for="afqpfile" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="afqpfile" name="afqpattachement[]"
                                                        oninput="addMultipleFiles(this, 'attachement_afqp')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>







                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-afqr" class="tabcontent">
                        <div class="orig-head">
                            Annexure For Qualification Report
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_afqr"></div>

                                        <div class="add-btn">
                                            <label for="afqrfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="afqrfile" name="afqrattachement[]"
                                                oninput="addMultipleFiles(this, 'attachement_afqr')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>





                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-afurs" class="tabcontent">
                        <div class="orig-head">
                            Annexure For User Requirement Specification
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_afurs"></div>

                                        <div class="add-btn">
                                            <label for="afursfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="afursfile" name="afursattachement[]"
                                                oninput="addMultipleFiles(this, 'attachement_afurs')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>




                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-aqp" class="tabcontent">
                        <div class="orig-head">
                            Area Qualification Protocol
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_aqp"></div>

                                        <div class="add-btn">
                                            <label for="aqpfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="aqpfile" name="aqpattachement[]"
                                                oninput="addMultipleFiles(this, 'attachement_aqp')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-aqr" class="tabcontent">
                        <div class="orig-head">
                            Area Qualification Report
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments">Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_aqr"></div>

                                        <div class="add-btn">
                                            <label for="aqrfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="aqrfile" name="aqrattachement[]"
                                                oninput="addMultipleFiles(this, 'attachement_aqr')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>





                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-pfmf" class="tabcontent">
                        <div class="orig-head">
                            Protocol For Media Fill
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_pfmf"></div>

                                        <div class="add-btn">
                                            <label for="pfmffile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="pfmffile" name="pfmfattachement[]"
                                                oninput="addMultipleFiles(this, 'attachement_pfmf')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-rfmf" class="tabcontent">
                        <div class="orig-head">
                            Report For Media Fill
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_rfmf"></div>

                                        <div class="add-btn">
                                            <label for="rfmffile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="rfmffile" name="rfmfattachement[]"
                                                oninput="addMultipleFiles(this, 'attachement_rfmf')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-asr" class="tabcontent">
                        <div class="orig-head">
                            Annexure-XIX - System Retirement
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_asr"></div>

                                        <div class="add-btn">
                                            <label for="asrfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="asrfile" name="annex_XIX_syst_retir_attachment[]"
                                                oninput="addMultipleFiles(this, 'attachement_asr')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-atm" class="tabcontent">
                        <div class="orig-head">
                            Annexure-XVIII - Traceability Matrix
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_atm"></div>

                                        <div class="add-btn">
                                            <label for="atmfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="atmfile" name="annex_XVIII_trac_matri_attachment[]"
                                                oninput="addMultipleFiles(this, 'attachement_atm')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-avsr" class="tabcontent">
                        <div class="orig-head">
                            Annexure-XVII - Validation Summary Report

                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_avsr"></div>

                                        <div class="add-btn">
                                            <label for="avsrfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="avsrfile" name="annex_XVII_valid_summ_attachment[]"
                                                oninput="addMultipleFiles(this, 'attachement_avsr')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-aiiopq" class="tabcontent">
                        <div class="orig-head">
                            Annexure-XVI - Installation_Infrastructure_Operational_Performance Qualification
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Closure Attachments"> Attachment</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="attachement_aiiopq"></div>

                                        <div class="add-btn">
                                            <label for="aiiopqfile" style="cursor: pointer;">Add</label>
                                            <input type="file" id="aiiopqfile" name="annex_XVI_per_qualif_attachment[]"
                                                oninput="addMultipleFiles(this, 'attachement_aiiopq')" multiple hidden>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            function addMultipleFiles(input, listId) {
                                let fileList = document.getElementById(listId);
                                fileList.innerHTML = ""; // Clear previous files (if needed)

                                for (let file of input.files) {
                                    let fileItem = document.createElement("div");
                                    fileItem.textContent = file.name;
                                    fileList.appendChild(fileItem);
                                }
                            }
                            </script>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>




                    {{-- Hold Time Study Protocol Tabs --}}
                    <div id="doc-htsp" class="tabcontent">
                        <div class="orig-head">
                            Hold Time Study Protocol</div>
                            <div class="input-fields">
                                <div class="row">

                                    {{-- comment for tempary --}}
                                {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Purpose">Purpose</label>
                                            <textarea name="htsp_purpose"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="scope">Scope</label>
                                            <textarea name="htsp_scope"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="responsibilityhtps" id="responsibilityhtps">
                                                Responsibility<button type="button" id="responsibilityhtpsbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="responsibilityhtpsdiv">
                                                <div class="ResponsibilityBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_responsibility[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subresponsibilityhtpsAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="test">
                                                Revision History
                                            </label>
                                            <div><small class="text-primary"></small></div>
                                            <div class="table-responsive retrieve-table">
                                            <table class="table-bordered table" id="">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th class="copy-name">Revision No.</th>
                                                        <th class="copy-name">Change Control No./ DCRF No</th>
                                                        <th class="copy-name">Effective Date</th>
                                                        <th class="copy-name">Reason of revision</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><input type="text" id="" name="revision_number" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="cc_no" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="revised_effective_date" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="reason_of_revision" value="" class="form-control"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div> --}}
                                   {{-- coomment for tempary --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="htspdescription" id="htspdescription">
                                                Description of SOP s To Be Followed<button type="button" id="htspdescriptionbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="htspdescriptiondiv">
                                                <div class="htspdescriptionBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_description_of_sop[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subhtspdescriptionAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Specifications" id="Specifications">
                                                Specifications<button type="button" id="Specificationsbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <div id="Specificationsdiv">
                                                <div class="SpecificationsBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_specifications[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subSpecificationsAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="abbreviation" id="abbreviation">
                                                bulk stage<button type="button" id="abbreviationbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>


                                            <div id="abbreviationdiv">
                                                <div class="singleAbbreviationBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_bulk_stage[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subAbbreviationAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                {{-- comment for temp --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Samplinghtps" id="Samplinghtps">
                                                Sampling & Analysis Plan<button type="button" id="Samplinghtpsbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>



                                            <div id="Samplinghtpsdiv">

                                                <div class="SamplinghtpsBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_sampling_analysis[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subSamplinghtpsAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Environmentalhtsp" id="Environmentalhtspdiv">
                                                Environmental Conditions During Hold Time<button type="button" id="Environmentalhtspbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="Environmentalhtspdiv" >
                                                <div class="EnvironmentalhtspBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_environmental_conditions[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button" class="subEnvironmentalhtspAdd"
                                                                name="button">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                --}}
                                    {{-- <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="procedure">Procedure</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <textarea name="procedure" class="summernote">
                                        </textarea>
                                        </div>
                                    </div> --}}

                                    <!-- <div class="col-md-12 mb-3">
                                                                <div class="group-input">
                                                                    <label for="procedure" id="newreport">
                                                                    Procedure<button type="button" id="reportingbtadd" name="button">+</button>
                                                                    </label>
                                                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>

                                                                    <div id="reportingdiv">
                                                                        <div class="singleReportingBlock">
                                                                            <div class="row">
                                                                                <div class="col-sm-10">
                                                                                    <textarea name="procedure[]" class=""></textarea>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button class="btn btn-dark subReportingAdd">+</button>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div> -->


                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Samplehtps" id="Samplehtps">
                                                Sample Quantity Calculation<button type="button" id="Samplehtpsbtnadd"
                                                    name="button">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Samplehtpsdiv">
                                                <div class="SamplehtpsBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_sample_quantity_calculation[]" class=""></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subSamplehtpsAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Deviationhtps" id="Deviationhtps">
                                                Deviation<button type="button" id="Deviationhtpsbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Deviationhtpsdiv">
                                                <div class="DeviationhtpsBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_deviation[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subDeviationhtpsAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>




                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Summaryhtps" id="Summaryhtps">
                                                Summary<button type="button" id="Summaryhtpsbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Summaryhtpsdiv">
                                                <div class="SummaryhtpsBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_summary[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subSummaryhtpsAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Conclusionhtps" id="Conclusionhtps">
                                                Conclusion<button type="button" id="Conclusionhtpsbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Conclusionhtpsdiv">
                                                <div class="ConclusionhtpsBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_conclusion[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subConclusionhtpseAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments"> Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachement_htsp"></div>

                                                <div class="add-btn">
                                                    <label for="htpsfile" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="htpsfile" name="htspattachement[]"
                                                        oninput="addMultipleFiles(this, 'attachement_htsp')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>



                                    {{-- <div class="input-fields">
                                        <div class="group-input">
                                            <label for="distribution-list" style="font-weight: bold;">
                                                Distribution List
                                            </label>
                                            <div class="table-responsive retrieve-table">
                                                <table class="table table-bordered" id="distribution-list">
                                                    <thead>
                                                        <tr>
                                                            <th>Row</th>
                                                            <th class="copy-name">Copy</th>
                                                            <th class="copy-name">No. of Copies</th>
                                                            <th class="copy-name">User Department</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td style="font-weight: bold;">Master Copy</td>
                                                            <td><input type="text" id="copies-master"
                                                                    name="master_copy_number" value=""
                                                                    class="form-control">
                                                            </td>

                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                        <input type="text" name="master_user_department">

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td style="font-weight: bold;">Controlled Copy</td>
                                                            <td><input type="text" id="copies-controlled"
                                                                    name="controlled_copy_number" value=""
                                                                    class="form-control"></td>

                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                    <input type="text" name="controlled_user_department">

                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td style="font-weight: bold;">Display Copy</td>
                                                            <td><input type="text" id="copies-display"
                                                                    name="display_copy_number" value=""
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                        <input type="text" name="display_user_department">

                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> --}}


                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                {{-- packing validation protocol --}}
                    <div id="doc-pvp" class="tabcontent">
                        <div class="orig-head">
                            Packing validation Protocol</div>
                            <div class="input-fields">
                                <div class="row">
                                    {{-- <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="comments">Dosage Form</label>
                                            <input type="text" name="dosageform_pvp">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="train-require">Packing Validation Protocol for</label>
                                            <input type="text" name="packingvalidation_pvp">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="comments">PRODUCT NAME</label>
                                            <input type="text" name="productname_pvp">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="train-require">Protocol No</label>
                                            <input type="text" name="protocolno_pvp">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="group-input">
                                            <label for="comments">Batch No</label>
                                            <input type="text" name="batchno_pvp">
                                        </div>
                                    </div>


                                    <div class="">
                                        PRODUCT DETAILS
                                      </div>  <br>
                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="purpose">Generic Name </label>
                                              <input type="text" name="generic_pvp">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">Product Code</label>
                                              <input type="text" name="pvp_product_code">
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">Std. Batch size </label>
                                              <input type="text" name="pvp_std_batch">
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">Category</label>
                                              <input type="text" name="pvp_category">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">Label Claim  </label>
                                              <input type="text" name="pvp_label_claim">
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">Market</label>
                                              <input type="text" name="pvp_market">
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">Shelf Life</label>
                                              <input type="text" name="pvp_shelf_life">
                                          </div>
                                      </div>

                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">BMR No.</label>
                                              <input type="text" name="pvp_bmr_no">
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="group-input">
                                              <label for="scope">MFR No.</label>
                                              <input type="text" name="pvp_mfr_no">
                                          </div>
                                      </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Purpose">Purpose</label>
                                            <textarea name="pvp_purpose"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="scope">Scope</label>
                                            <textarea name="pvp_scope"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="reasonforvalidationpvp" id="reasonforvalidationpvp">
                                                Reason for validation<button type="button" id="reasonforvalidationpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="reasonforvalidationpvpdiv">
                                                <div class="reasonforvalidationpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="reasonfor_validationpvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subreasonforvalidationpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="responsibilitypvp" id="responsibilitypvp">
                                                Responsibility<button type="button" id="responsibilitypvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="responsibilitypvpdiv">
                                                <div class="responsibilitypvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="pvp_responsibility[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subresponsibilitypvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="test">
                                                Revision History
                                            </label>
                                            <div><small class="text-primary"></small></div>
                                            <div class="table-responsive retrieve-table">
                                            <table class="table-bordered table" id="">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th class="copy-name">Revision No.</th>
                                                        <th class="copy-name">Change Control No./ DCRF No</th>
                                                        <th class="copy-name">Effective Date</th>
                                                        <th class="copy-name">Reason of revision</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><input type="text" id="" name="revision_number" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="cc_no" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="revised_effective_date" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="reason_of_revision" value="" class="form-control"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div> --}}
                                  {{-- comment for tempary --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="validationpvp" id="validationpvp">
                                                Validation Policy<button type="button" id="validationpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="validationpvpdiv">
                                                <div class="validationpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="pvp_validationpvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subvalidationpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="descriptionsoppvp" id="descriptionsoppvp">
                                                Description of SOP<button type="button" id="descriptionsoppvpbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <div id="descriptionsoppvpdiv">
                                                <div class="descriptionsoppvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="descriptionsop_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subdescriptionsoppvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        --}}

                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="abbreviation" id="abbreviation">
                                                bulk stage<button type="button" id="abbreviationbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>


                                            <div id="abbreviationdiv">
                                                <div class="singleAbbreviationBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_bulk_stage[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subAbbreviationAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                 {{-- comment for tempary --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="packingmaterialpvp" id="packingmaterialpvp">
                                                Packing material approved vendor details<button type="button" id="packingmaterialpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>



                                            <div id="packingmaterialpvpdiv">

                                                <div class="packingmaterialpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="packingmaterial_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subpackingmaterialpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="equipmentpvp" id="equipmentpvp">
                                              Equipment Calibration & Qualification Status<button type="button" id="equipmentpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="equipmentpvpdiv" >
                                                <div class="equipmentpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="equipment_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button" class="subequipmentpvpAdd"
                                                                name="button">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                        --}}
                                    {{-- <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="procedure">Procedure</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <textarea name="procedure" class="summernote">
                                        </textarea>
                                        </div>
                                    </div> --}}

                                    <!-- <div class="col-md-12 mb-3">
                                                                <div class="group-input">
                                                                    <label for="procedure" id="newreport">
                                                                    Procedure<button type="button" id="reportingbtadd" name="button">+</button>
                                                                    </label>
                                                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>

                                                                    <div id="reportingdiv">
                                                                        <div class="singleReportingBlock">
                                                                            <div class="row">
                                                                                <div class="col-sm-10">
                                                                                    <textarea name="procedure[]" class=""></textarea>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button class="btn btn-dark subReportingAdd">+</button>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div> -->


                                   {{-- comment for tempary --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="rationalepvp" id="rationalepvp">
                                                Rationale for selection of critical steps<button type="button" id="rationalepvpbtnadd"
                                                    name="button">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="rationalepvpdiv">
                                                <div class="rationalepvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="rationale_pvp[]" class=""></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subrationalepvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="samplingpvp" id="samplingpvp">
                                              Sampling Plan & Procedure<button type="button" id="samplingpvpbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="samplingpvpdiv">
                                                <div class="samplingpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="sampling_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subsamplingpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>




                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Criticalpvp" id="Criticalpvp">
                                                Critical Process Parameters & Critical quality Attributes<button type="button" id="Criticalpvpbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Criticalpvpdiv">
                                                <div class="CriticalpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="critical_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subCriticalpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="ProductAcceptancepvp" id="ProductAcceptancepvp">
                                                Product Acceptance Criteria<button type="button" id="ProductAcceptancepvpbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="ProductAcceptancepvpdiv">
                                                <div class="ProductAcceptancepvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="product_acceptancepvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subProductAcceptancepvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="Holdtimepvp" id="Holdtimepvp">
                                                Hold time study<button type="button" id="Holdtimepvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="Holdtimepvpdiv">
                                                <div class="HoldtimepvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="Holdtime_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subHoldtimepvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="test">
                                                Revision History
                                            </label>
                                            <div><small class="text-primary"></small></div>
                                            <div class="table-responsive retrieve-table">
                                            <table class="table-bordered table" id="">
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No.</th>
                                                        <th class="copy-name">Revision No.</th>
                                                        <th class="copy-name">Change Control No./ DCRF No</th>
                                                        <th class="copy-name">Effective Date</th>
                                                        <th class="copy-name">Reason of revision</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td><input type="text" id="" name="revision_number" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="cc_no" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="revised_effective_date" value="" class="form-control"></td>
                                                        <td><input type="text" id="" name="reason_of_revision" value="" class="form-control"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div> --}}
                                  {{-- comment for tempary --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">

                                            <label for="Cleaningvalidationpvp" id="Cleaningvalidationpvp">
                                              Cleaning validation<button type="button" id="Cleaningvalidationpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="Cleaningvalidationpvpdiv">
                                                <div class="CleaningvalidationpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="cleaning_validationpvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subCleaningvalidationpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Stabilitystudypvp" id="Stabilitystudypvp">
                                                Stability study<button type="button" id="Stabilitystudypvpbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <div id="Stabilitystudypvpdiv">
                                                <div class="StabilitystudypvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="Stability_studypvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subStabilitystudypvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="abbreviation" id="abbreviation">
                                                bulk stage<button type="button" id="abbreviationbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>


                                            <div id="abbreviationdiv">
                                                <div class="singleAbbreviationBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="htsp_bulk_stage[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subAbbreviationAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                      {{-- comment for temapry --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Deviationpvp" id="Deviationpvp">
                                                Deviation<button type="button" id="Deviationpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>



                                            <div id="Deviationpvpdiv">

                                                <div class="DeviationpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="Deviation_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subDeviationpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Changecontrolpvp" id="Changecontrolpvp">
                                                Change control<button type="button" id="Changecontrolpvpbtnadd"
                                                    name="button">+</button>
                                                <div><small class="text-primary">Please insert "NA" in the data field if it
                                                        does not require completion</small></div>
                                            </label>

                                            <div id="Changecontrolpvpdiv" >
                                                <div class="ChangecontrolpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="Change_controlpvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button type="button" class="subChangecontrolpvpAdd"
                                                                name="button">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                --}}
                                    {{-- <div class="col-md-12 mb-3">
                                        <div class="group-input">
                                            <label for="procedure">Procedure</label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>
                                            <textarea name="procedure" class="summernote">
                                        </textarea>
                                        </div>
                                    </div> --}}

                                    <!-- <div class="col-md-12 mb-3">
                                                                <div class="group-input">
                                                                    <label for="procedure" id="newreport">
                                                                    Procedure<button type="button" id="reportingbtadd" name="button">+</button>
                                                                    </label>
                                                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>

                                                                    <div id="reportingdiv">
                                                                        <div class="singleReportingBlock">
                                                                            <div class="row">
                                                                                <div class="col-sm-10">
                                                                                    <textarea name="procedure[]" class=""></textarea>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button class="btn btn-dark subReportingAdd">+</button>
                                                                                </div>
                                                                                <div class="col-sm-1">
                                                                                    <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div> -->


                                  {{-- comment for temp --}}
                                    {{-- <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Summarypvp" id="Summarypvp">
                                                Summary<button type="button" id="Summarypvpbtnadd"
                                                    name="button">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Summarypvpdiv">
                                                <div class="SummarypvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="Summary_pvp[]" class=""></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subSummarypvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="group-input">
                                            <label for="Conclusionpvp" id="Conclusionpvp">
                                                Conclusion<button type="button" id="Conclusionpvpbtnadd">+</button>
                                            </label>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                    not require completion</small></div>

                                            <div id="Conclusionpvpdiv">
                                                <div class="ConclusionpvpBlock">
                                                    <div class="row">
                                                        <div class="col-sm-10">
                                                            <textarea name="Conclusion_pvp[]" class="myclassname"></textarea>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-dark subConclusionpvpAdd">+</button>
                                                        </div>
                                                        <div class="col-sm-1">
                                                            <button class="btn btn-danger removeAllBlocks">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> --}}

                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments"> Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachement_pvp"></div>

                                                <div class="add-btn">
                                                    <label for="pvpfile" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="pvpfile" name="pvpattachement[]"
                                                        oninput="addMultipleFiles(this, 'attachement_pvp')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    function addMultipleFiles(input, listId) {
                                        let fileList = document.getElementById(listId);
                                        fileList.innerHTML = ""; // Clear previous files (if needed)

                                        for (let file of input.files) {
                                            let fileItem = document.createElement("div");
                                            fileItem.textContent = file.name;
                                            fileList.appendChild(fileItem);
                                        }
                                    }
                                    </script>









                                    {{-- <div class="input-fields">
                                        <div class="group-input">
                                            <label for="distribution-list" style="font-weight: bold;">
                                                Distribution List
                                            </label>
                                            <div class="table-responsive retrieve-table">
                                                <table class="table table-bordered" id="distribution-list">
                                                    <thead>
                                                        <tr>
                                                            <th>Row</th>
                                                            <th class="copy-name">Copy</th>
                                                            <th class="copy-name">No. of Copies</th>
                                                            <th class="copy-name">User Department</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td style="font-weight: bold;">Master Copy</td>
                                                            <td><input type="text" id="copies-master"
                                                                    name="master_copy_number" value=""
                                                                    class="form-control">
                                                            </td>

                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                        <input type="text" name="master_user_department">

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td style="font-weight: bold;">Controlled Copy</td>
                                                            <td><input type="text" id="copies-controlled"
                                                                    name="controlled_copy_number" value=""
                                                                    class="form-control"></td>

                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                    <input type="text" name="controlled_user_department">

                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td style="font-weight: bold;">Display Copy</td>
                                                            <td><input type="text" id="copies-display"
                                                                    name="display_copy_number" value=""
                                                                    class="form-control">
                                                            </td>
                                                            <td>
                                                                <div class="col-md-6">
                                                                    <div class="group-input">
                                                                        <input type="text" name="display_user_department">

                                                                    </div>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> --}}


                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    {{-- Rajendra code end   --}}

                    <div id="doc-AIQP" class="tabcontent">
                        <div class="orig-head">Annexure For Acceptance Of Installation Qualification Protocol</div>
                            <div class="input-fields">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments"> Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachement_AIQP"></div>

                                                <div class="add-btn">
                                                    <label for="AIQPfile" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="AIQPfile" name="AIQPattachement[]"
                                                        oninput="addMultipleFiles(this, 'attachement_AIQP')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function addMultipleFiles(input, listId) {
                                            let fileList = document.getElementById(listId);
                                            fileList.innerHTML = ""; // Clear previous files (if needed)

                                            for (let file of input.files) {
                                                let fileItem = document.createElement("div");
                                                fileItem.textContent = file.name;
                                                fileList.appendChild(fileItem);
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-AOQP" class="tabcontent">
                        <div class="orig-head">Annexure For Acceptance Of Operational Qualification Protocol</div>
                            <div class="input-fields">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments"> Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachement_AOQP"></div>

                                                <div class="add-btn">
                                                    <label for="AOQPfile" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="AOQPfile" name="AOQPattachement[]"
                                                        oninput="addMultipleFiles(this, 'attachement_AOQP')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function addMultipleFiles(input, listId) {
                                            let fileList = document.getElementById(listId);
                                            fileList.innerHTML = ""; // Clear previous files (if needed)

                                            for (let file of input.files) {
                                                let fileItem = document.createElement("div");
                                                fileItem.textContent = file.name;
                                                fileList.appendChild(fileItem);
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="doc-APQP" class="tabcontent">
                        <div class="orig-head">Annexure For Acceptance Of Performance Qualification Protocol</div>
                            <div class="input-fields">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="group-input">
                                            <label for="Closure Attachments"> Attachment</label>
                                            <div><small class="text-primary">Please Attach all relevant or supporting documents</small></div>

                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="attachement_APQP"></div>

                                                <div class="add-btn">
                                                    <label for="APQPfile" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="APQPfile" name="APQPattachement[]"
                                                        oninput="addMultipleFiles(this, 'attachement_APQP')" multiple hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                        function addMultipleFiles(input, listId) {
                                            let fileList = document.getElementById(listId);
                                            fileList.innerHTML = ""; // Clear previous files (if needed)

                                            for (let file of input.files) {
                                                let fileItem = document.createElement("div");
                                                fileItem.textContent = file.name;
                                                fileList.appendChild(fileItem);
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    


                    {{-- Raw Material Specifications Tabs --}}
                    <div id="doc-rawms" class="tabcontent">
                        <div class="orig-head">
                           Raw Material Specifications</div>
                        <div class="input-fields">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">CAS No.</label>
                                        <input type="text" name="cas_no_row_material">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="generic-name">Material Name</label>
                                        <input type="text" name="material_name">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="brand-name">Molecular Formula</label>
                                        <input type="text" name="molecular_formula_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Molecular Weight</label>
                                        <input type="text" name="molecular_weight_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="product-code">Storage Condition</label>
                                        <input type="text" name="storage_condition_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="retest-period">Retest Period</label>
                                        <input type="text" name="retest_period_row_material">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sampling-procedure">Sampling Procedure</label>
                                        <input type="text" name="sampling_procedure_row_material">
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                     Sampling Procedure
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="sampling_procedure_row_material" class="summernote"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="item-code">Item Code</label>
                                        <input type="text" name="item_code_row_material">
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity_row_material">
                                            <option value="" selected>--Select--</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>
                                        </select>
                                    </div>
                                </div> --}}

                                <div class="col-12 sub-head">
                                    Sample Quantity for Analysis
                                    <div class="group-input">
                                        <label for="procedure"></label>
                                        <textarea name="sample_quantity_row_material" class="summernote"></textarea>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="reserve-sample">Reserve Sample Quantity</label>
                                        <input type="text" name="reserve_sample_quantity_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="retest-sample">Sample Quantity for Retest</label>
                                        <input type="text" name="retest_sample_quantity_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sampling-instructions">Sampling Instructions, Warnings, and Precautions</label>
                                        <input type="text" name="sampling_instructions_row_material">
                                    </div>
                                </div>


                            {{-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> --}}
                            {{-- <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                          SPECIFICATION
                                        <button type="button" id="row_material_add">+</button>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="row_material_details" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Sr. No.</th>
                                                    <th>Test</th>
                                                    <th>Specification</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Initial Row Placeholder (Optional) -->
                                                <tr>
                                                    <td><input disabled type="text" name="Row_Materail[0][serial]" value="1"></td>
                                                    <td><input type="text" name="Row_Materail[0][specification_row_material]"></td>
                                                    <td><input type="text" name="Row_Materail[0][test]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    // Add new row in Specification Details table
                                    $('#row_material_add').click(function(e) {
                                        e.preventDefault();

                                        function generateSpecificationTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="Row_Materail[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="Row_Materail[' + serialNumber + '][specification_row_material]"></td>' +
                                                '<td><input type="text" name="Row_Materail[' + serialNumber + '][test]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#row_material_details tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateSpecificationTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });

                                    // Remove row in Specification Details table
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });
                                });
                            </script> --}}

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="procedure">Specifications</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="rawmaterials_specifications" class="summernote">
                                    </textarea>
                                    </div>
                                </div>






                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" id="DocnextButton"
                                onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    <div id="annexures" class="tabcontent">
                        <div class="input-fields">
                            @for ($i = 1; $i <= 30; $i++)
                                <div class="group-input">
                                    <label for="annexure-{{ $i }}">Annexure</label>
                                    <textarea class="summernote" name="annexuredata[]" id="annexure-{{ $i }}"></textarea>
                                </div>
                            @endfor
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    {{-- HOD REMARKS TAB START --}}
                    <div id="hod-remarks-tab" class="tabcontent">

                        <div class="input-fields">
                            <div class="group-input">
                                <label for="hod-remark">HOD Comments</label>
                                <textarea class="summernote" name="hod_comments"></textarea>
                            </div>
                        </div>

                        <div class="input-fields">
                            <div class="group-input">
                                <label for="hod-attachments">HOD Attachments</label>
                                <input type="file" name="hod_attachments[]" multiple>
                            </div>
                        </div>

                        <div class="button-block">
                            <button type="submit" value="save" name="submit" id="DocsaveButton"
                                class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>

                    </div>
                    {{-- HOD REMARKS TAB END --}}


                    <div id="distribution-retrieval" class="tabcontent">
                        <div class="orig-head">
                            Distribution & Retrieval
                        </div>
                        {{-- <div class="col-md-12 input-fields">
                            <div class="group-input">
                                <label for="distribution" id="distribution">
                                    Distribution & Retrieval<button type="button" id="distributionbtnadd" >+</button>
                                </label>
                                <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div>
                                <input type="text" name="distribution[]" class="myclassname">
                                <div id="distributiondiv"></div>
                            </div>
                        </div> --}}
                        <div class="input-fields">
                            <div class="group-input">
                                <label for="distriution_retrieval">
                                    Distribution & Retrieval
                                    <button type="button" name="    "
                                        onclick="addDistributionRetrieval('distribution-retrieval-grid')" disabled>+</button>
                                </label>
                                <div class="table-responsive retrieve-table">
                                    <table class="table table-bordered" id="distribution-retrieval-grid">
                                        <thead>
                                            <tr>
                                                <th>Row </th>
                                                <th>Document Title</th>
                                                <th>Document Number</th>
                                                <th>Document Printed By</th>
                                                <th>Document Printed on</th>
                                                <th>Number of Print Copies</th>
                                                <th>Issuance Date</th>
                                                <th>Issued To </th>
                                                <th>Department/Location</th>
                                                <th>Number of Issued Copies</th>
                                                <th>Reason for Issuance</th>
                                                <th>Retrieval Date</th>
                                                <th>Retrieved By</th>
                                                <th>Retrieved Person Department</th>
                                                <th>Number of Retrieved Copies</th>
                                                <th>Reason for Retrieval</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- <tr>
                                                 <td><input type="text" Value="1" name="distribution[0][serial_number]" readonly>
                                                 </td>
                                                 <td><input type="text" name="distribution[0][document_title]">
                                                 </td>
                                                 <td><input type="number" name="distribution[0][document_number]">
                                                 </td>
                                                 <td><input type="text" name="distribution[0][document_printed_by]">
                                                 </td>
                                                 <td><input type="text" name="distribution[0][document_printed_on]">
                                                 </td>
                                                 <td><input type="number" name="distribution[0][document_printed_copies]">
                                                 </td>
                                                 <td><div class="group-input new-date-data-field mb-0">
                                                    <div class="input-date "><div
                                                     class="calenderauditee">
                                                    <input type="text" id="issuance_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                                                    <input type="date" name="distribution[0][issuance_date]" class="hide-input"
                                                    oninput="handleDateInput(this, `issuance_date' + serialNumber +'`)" /></div></div></div>
                                                </td>

                                                    <td>
                                                        <select id="select-state" placeholder="Select..."
                                                            name="distribution[0][issuance_to]">
                                                            <option value='0'>-- Select --</option>
                                                            <option value='1'>Amit Guru</option>
                                                            <option value='2'>Shaleen Mishra</option>
                                                            <option value='3'>Madhulika Mishra</option>
                                                            <option value='4'>Amit Patel</option>
                                                            <option value='5'>Harsh Mishra</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select id="select-state" placeholder="Select..."
                                                            name="distribution[0][location]">
                                                            <option value='0'>-- Select --</option>
                                                            <option value='1'>Tech Team</option>
                                                            <option value='2'>Quality Assurance</option>
                                                            <option value='3'>Quality Management</option>
                                                            <option value='4'>IT Administration</option>
                                                            <option value='5'>Business Administration</option>
                                                        </select>
                                                    </td>
                                                <td><input type="number" name="distribution[0][issued_copies]">
                                                </td>
                                                <td><input type="text" name="distribution[0][issued_reason]">
                                                </td>
                                                <td><div class="group-input new-date-data-field mb-0">
                                                    <div class="input-date "><div
                                                     class="calenderauditee">
                                                    <input type="text" id="retrieval_date' + serialNumber +'" readonly placeholder="DD-MMM-YYYY" />
                                                    <input type="date" name="distribution[0][retrieval_date]" class="hide-input"
                                                    oninput="handleDateInput(this, `retrieval_date' + serialNumber +'`)" /></div></div></div>
                                                </td>
                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="distribution[0][retrieval_by]">
                                                        <option value="">Select a value</option>
                                                        <option value='1'>Amit Guru</option>
                                                        <option value='2'>Shaleen Mishra</option>
                                                        <option value='3'>Madhulika Mishra</option>
                                                        <option value='4'>Amit Patel</option>
                                                        <option value='5'>Harsh Mishra</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select id="select-state" placeholder="Select..."
                                                        name="distribution[0][retrieved_department]">
                                                        <option value='0'>-- Select --</option>
                                                        <option value='1'>Tech Team</option>
                                                        <option value='2'>Quality Assurance</option>
                                                        <option value='3'>Quality Management</option>
                                                        <option value='4'>IT Administration</option>
                                                        <option value='5'>Business Administration</option>
                                                    </select>
                                                </td>
                                                <td><input type="number" name="distribution[0][retrieved_copies]">
                                                </td>
                                                <td><input type="text" name="distribution[0][retrieved_reason]">
                                                </td>
                                                <td><input type="text" name="distribution[0][remark]">
                                                </td>
                                                <td></td>
                                        </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"> Exit
                                </a>
                            </button>
                        </div>
                    </div>

                    {{-- <div id="print-download" class="tabcontent">
                        <div class="orig-head">
                            Print Permissions
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="person-print">Person Print Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Person</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    Amit Patel
                                                </td>
                                                <td class="permission">
                                                    6543
                                                </td>
                                                <td class="permission">
                                                    6543
                                                </td>
                                                <td class="permission">
                                                    6543
                                                </td>
                                                <td class="permission">
                                                    432
                                                </td>
                                                <td class="permission">
                                                    123
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="group-print">Group Print Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Group</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    QA
                                                </td>
                                                <td class="permission">1</td>
                                                <td class="permission">
                                                    54
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                                <td class="permission">
                                                    765
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="orig-head">
                            Download Permissions
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="person-print">Person Download Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Person</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    Amit Patel
                                                </td>
                                                <td class="permission">1</td>
                                                <td class="permission">
                                                    54
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                                <td class="permission">
                                                    765
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="group-print">Group Download Permission</label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Persons" multiple>
                                            <option value="HTML">HTML</option>
                                            <option value="Jquery">Jquery</option>
                                            <option value="CSS">CSS</option>
                                            <option value="Bootstrap 3">Bootstrap 3</option>
                                            <option value="Bootstrap 4">Bootstrap 4</option>
                                            <option value="Java">Java</option>
                                            <option value="Javascript">Javascript</option>
                                            <option value="Angular">Angular</option>
                                            <option value="Python">Python</option>
                                            <option value="Hybris">Hybris</option>
                                            <option value="SQL">SQL</option>
                                            <option value="NOSQL">NOSQL</option>
                                            <option value="NodeJS">NodeJS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <table class="table-bordered table">
                                            <thead>
                                                <th class="person">Group</th>
                                                <th class="permission">Daily</th>
                                                <th class="permission">Weekly</th>
                                                <th class="permission">Monthly</th>
                                                <th class="permission">Quarterly</th>
                                                <th class="permission">Annually</th>
                                            </thead>
                                            <tbody>
                                                <td class="person">
                                                    QA
                                                </td>
                                                <td class="permission">1</td>
                                                <td class="permission">
                                                    54
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                                <td class="permission">
                                                    765
                                                </td>
                                                <td class="permission">
                                                    654
                                                </td>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a  href="{{ url('rcms/qms-dashboard') }}" class="text-white" > Exit </a>
</button>
</div>
</div> --}}

                    <div id="sign" class="tabcontent">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Originated By
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Originated On
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Comments
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                    HOD Review By
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                       HOD Review On
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                       Comments
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Reviewed By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Reviewed On
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Comments
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Approved By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Approved On
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Comments
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="submit">Submit</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white"
                                    href="#"> Exit </a> </button>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>

    {{-- ======================================
                  DIVISION MODAL

    ======================================= --}}
    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>

    <script>
        var editor = new FroalaEditor('.summernote', {
            key: "uXD2lC7C4B4D4D4J4B11dNSWXf1h1MDb1CF1PLPFf1C1EESFKVlA3C11A8D7D2B4B4G2D3J3==",
            imageUploadParam: 'image_param',
            imageUploadMethod: 'POST',
            imageMaxSize: 20 * 1024 * 1024,
            imageUploadURL: "{{ route('api.upload.file') }}",
            fileUploadParam: 'image_param',
            fileUploadURL: "{{ route('api.upload.file') }}",
            videoUploadParam: 'image_param',
            videoUploadURL: "{{ route('api.upload.file') }}",
            videoMaxSize: 500 * 1024 * 1024,
        });
    </script>

    <script>
        VirtualSelect.init({
            ele: '#reference_record, #parent_child, #notify_to'
        });

        $('#summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear', 'italic']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        let referenceCount = 1;

        function addReference() {
            referenceCount++;
            let newReference = document.createElement('div');
            newReference.classList.add('row', 'reference-data-' + referenceCount);
            newReference.innerHTML = `
            <div class="col-lg-6">
                <input type="text" name="reference-text">
            </div>
            <div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div><div class="col-lg-6">
                <input type="file" name="references" class="myclassname">
            </div>
        `;
            let referenceContainer = document.querySelector('.reference-data');
            referenceContainer.parentNode.insertBefore(newReference, referenceContainer.nextSibling);
        }
    </script>

    {{-- <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script> --}}
    {{-- <script>
        var maxLength = 255;
        $('#short_desc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#new-rchars').text(textlen);
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('#document-form').validate({
                rules: {
                    name: 'required',
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                // Add custom messages if needed
                messages: {
                    name: 'Please enter your name',
                    email: {
                        required: 'Please enter your email',
                        email: 'Please enter a valid email address'
                    },
                    password: {
                        required: 'Please enter a password',
                        minlength: 'Password must be at least 6 characters long'
                    }
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form if validation passes
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addButton').click(function() {
                var sourceValue = $('#sourceField').val()
                    .trim(); // Get the trimmed value from the source field
                if (!sourceValue) return; // Prevent adding empty values

                // Create a new list item with the source value and a close icon
                var newItem = $('<li>', {
                    class: 'd-flex justify-content-between align-items-center'
                }).text(sourceValue);
                var closeButton = $('<span>', {
                    text: '×',
                    class: 'close-icon ms-2' // Bootstrap class for margin-left spacing
                }).appendTo(newItem);

                // Append the new list item to the display field
                $('#displayField').append(newItem);

                // Create a corresponding option in the hidden select
                var newOption = $('<option>', {
                    value: sourceValue,
                    text: sourceValue,
                    selected: 'selected'
                }).appendTo('#keywords');

                // Clear the input field
                $('#sourceField').val('');

                // Add click event for the close icon
                closeButton.on('click', function() {
                    var thisValue = $(this).parent().text().slice(0, -
                        1); // Remove the '×' from the value
                    $(this).parent().remove(); // Remove the parent list item on click
                    $('#keywords option').filter(function() {
                        return $(this).val() === thisValue;
                    }).remove(); // Also remove the corresponding option from the select
                });
            });


            // $('#addButton').click(function() {
            //     var sourceValue = $('#sourceField').val(); // Get the value from the source field
            //     var targetField = $(
            //         '.targetField'); // The target field where the data will be added and selected

            //     // Create a new option with the source value
            //     var newOption = $('<option>', {
            //         value: sourceValue,
            //         text: sourceValue,
            //     });

            //     // Append the new option to the target field
            //     targetField.append(newOption);

            //     // Set the new option as selected
            //     newOption.prop('selected', true);
            //     $('#sourceField').val('');
            // });
        });

        $(document).on('click', '.removeTag', function() {
            $(this).remove();
        });
    </script>

    <script>
        function openData(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";

            // Find the index of the clicked tab button
            const index = Array.from(cctablinks).findIndex(button => button === evt.currentTarget);

            // Update the currentStep to the index of the clicked tab
            currentStep = index;
        }

        const saveButtons = document.querySelectorAll(".saveButton");
        const nextButtons = document.querySelectorAll(".nextButton");
        const form = document.getElementById("step-form");
        const stepButtons = document.querySelectorAll(".tablinks");
        const steps = document.querySelectorAll(".tabcontent");
        let currentStep = 0;

        function nextStep() {
            // Check if there is a next step
            if (currentStep < steps.length - 1) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show next step
                steps[currentStep + 1].style.display = "block";

                // Add active class to next button
                stepButtons[currentStep + 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep++;
            }
        }

        function previousStep() {
            // Check if there is a previous step
            if (currentStep > 0) {
                // Hide current step
                steps[currentStep].style.display = "none";

                // Show previous step
                steps[currentStep - 1].style.display = "block";

                // Add active class to previous button
                stepButtons[currentStep - 1].classList.add("active");

                // Remove active class from current button
                stepButtons[currentStep].classList.remove("active");

                // Update current step
                currentStep--;
            }
        }
    </script>
@endsection
