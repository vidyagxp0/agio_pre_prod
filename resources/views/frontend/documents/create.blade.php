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
            {{-- <div class="tab">
                <button class="tablinks active" onclick="openData(event, 'doc-info')" id="defaultOpen">Document
                    information</button>
                <button class="tablinks" onclick="openData(event, 'add-doc')">Training Information</button>
                <button class="tablinks" onclick="openData(event, 'doc-content')">Document Content</button>
                <button class="tablinks" onclick="openData(event, 'annexures')">Annexures</button>
                <button class="tablinks" onclick="openData(event, 'distribution-retrieval')">Distribution &
                    Retrieval</button>
                <button class="tablinks" onclick="openData(event, 'sign')">Signature</button>
                <button class="tablinks printdoc" style="float: right;"
                    onclick="window.print();return false;">Print</button>
            </div> --}}

            <div class="tab">
                <button class="tablinks active" onclick="openData(event, 'doc-info')" id="defaultOpen">Document
                 information</button>
                <button class="tablinks" onclick="openData(event, 'add-doc')">Training Information</button>
                <button class="tablinks" onclick="openData(event, 'doc-content')">Document Content</button>
                <!-- Tabs that should be hidden initially -->
                <button class="tablinks hidden-tabs" data-id="FPS" onclick="openData(event, 'doc_FPS')">Finished Product Specification</button>
                <button class="tablinks hidden-tabs" data-id="INPS" onclick="openData(event, 'doc_INPS')">Inprocess Specification</button>
                <button class="tablinks hidden-tabs" data-id="CVS" onclick="openData(event, 'doc_CVS')">Cleaning Validation Specification</button>

                <button class="tablinks hidden-tabs" data-id="FPSTP" onclick="openData(event, 'doc-fpstp')">Finished Product Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="INPSTP" onclick="openData(event, 'doc-istp')">Inprocess Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="CVSTP" onclick="openData(event, 'doc-cvstp')">Cleaning Validation Standard Testing Procedure</button>

                <button class="tablinks hidden-tabs" data-id="TEMPMAPPING" onclick="openData(event, 'doc-tempmapping')">Temperature Mapping Report</button>
                <button class="tablinks hidden-tabs" data-id="HOLDTIMESTUDYREPORT" onclick="openData(event, 'doc-holdtimstduy')">Hold Time Study Report</button>
                <button class="tablinks hidden-tabs" data-id="HOLDTIMESTUDYPROTOCOL" onclick="openData(event, 'doc-htsp')">Hold Time Study Protocol</button>


                <button class="tablinks hidden-tabs" data-id="RAWMS" onclick="openData(event, 'doc-rawms')">RAWMS SOP</button>

                <button class="tablinks hidden-tabs" data-id="RMSTP" onclick="openData(event, 'doc_rmstp')">Raw Material Standard Testing Procedure SOP</button>
                <button class="tablinks hidden-tabs" data-id="PAMS" onclick="openData(event, 'doc_pams')">Packing Material Specification</button>
                <button class="tablinks hidden-tabs" data-id="PROCUMREPORT" onclick="openData(event, 'doc_PCR')">Protocol Cum Report</button>

                <button class="tablinks hidden-tabs" data-id="PROVALIPROTOCOL" onclick="openData(event, 'doc_prvp')">Process Validation Protocol</button>

                <button class="tablinks hidden-tabs" data-id="PIAS" onclick="openData(event, 'doc_pias')">Product / Item Information-Addendum Specification</button>
                <button class="tablinks hidden-tabs" data-id="TDS" onclick="openData(event, 'doc-tds')">TDS</button>
                <button class="tablinks hidden-tabs" data-id="GTP" onclick="openData(event, 'doc-gtp')">GTP</button>
                <button class="tablinks hidden-tabs" data-id="MFPS" onclick="openData(event, 'doc-mfps')">MFPS</button>
                <button class="tablinks hidden-tabs" data-id="MFPSTP" onclick="openData(event, 'doc-mfpstp')">MFPSTP</button>
                <button class="tablinks hidden-tabs" data-id="STUDY" onclick="openData(event, 'doc-study')">Study Report</button>
                <button class="tablinks hidden-tabs" data-id="STUDYPROTOCOL" onclick="openData(event, 'doc-stprotocol')">Study Protocol</button>
                <button class="tablinks hidden-tabs" data-id="EQUIPMENTHOLDREPORT" onclick="openData(event, 'doc-eqpreport')">Equipment Hold Time Study Report</button>
                
                <button class="tablinks hidden-tabs" data-id="PROVALIDRE" onclick="openData(event, 'doc_pvr')">Process Validation Report</button>
                <button class="tablinks hidden-tabs" data-id="CLEAVALIPROTODOC" onclick="openData(event, 'doc_cvpd')">Cleaning Validation Protocol.doc</button>
             
                <button class="tablinks hidden-tabs" data-id="CLEAVALIREPORTDOC" onclick="openData(event, 'doc_cvrd')">Cleaning Validation Report.doc</button>
             
                <button class="tablinks hidden-tabs" data-id="STABILITYPROTOCOL" onclick="openData(event, 'doc_ssp')">STABILITY STUDY PROTOCOL</button>
             
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

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="document_name-desc">Document Name<span
                                                class="text-danger">*</span></label><span id="rchars">255</span>
                                        characters remaining
                                        <input id="docname" type="text" name="document_name" maxlength="255" required>
                                    </div>
                                    <p id="docnameError" style="color:red">**Document Name is required</p>

                                </div>
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="short-desc">Short Description<span class="text-danger">*</span></label>
                                        <span id="new-rchars">255</span>
                                        characters remaining
                                        <input type="text" id="short_desc" name="short_desc" maxlength="255">
                                    </div>
                                    <p id="short_descError" style="color:red">**Short description is required</p>

                                </div>
                                <!-- <div class="col-md-12">
                                                            <div class="group-input">
                                                                <label for="sop_type">SOP Type<span class="text-danger">*</span></label>
                                                                <select name="sop_type" required>
                                                                    <option value="" disabled selected>Enter your selection</option>
                                                                    <option value="SOP (Standard Operating procedure)">SOP (Standard Operating procedure)</option>
                                                                    <option value="EOP (Equipment Operating procedure)">EOP (Equipment Operating procedure)</option>
                                                                    <option value="IOP (Instrument Operating Procedure)">IOP (Instrument Operating Procedure)</option>
                                                                </select>
                                                            </div>

                                                        </div> -->


                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="sop_type">SOP Type<span class="text-danger">*</span></label>
                                        <select name="sop_type" id="sop_type" required onchange="updateSopTypeShort()">
                                            <option value="" disabled selected>Enter your selection</option>
                                            <option value="SOP (Standard Operating procedure)">SOP (Standard Operating
                                                procedure)</option>
                                            <option value="EOP (Equipment Operating procedure)">EOP (Equipment Operating
                                                procedure)</option>
                                            <option value="IOP (Instrument Operating Procedure)">IOP (Instrument Operating
                                                Procedure)</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="sop_type_short" id="sop_type_short">

                                <script>
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

                                    document.querySelector('form').addEventListener('submit', function() {
                                        updateSopTypeShort();
                                    });
                                </script>




                                <div class="col-md-4 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger">*</span></label>
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

                                        {{-- onchange="changeFormat(this,'due-dateDoc')"> --}}
                                    </div>
                                    <p id="due_dateDocError" style="color:red">**Due Date is required</p>

                                </div>
                                <div class="col-md-8">
                                    <div class="group-input">
                                        <label for="notify_to">Notify To</label>
                                        <select multiple name="notify_to[]" placeholder="Select Persons"
                                            data-search="false" data-silent-initial-value-set="true" id="notify_to">
                                            @foreach ($users as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}
                                                    {{-- ({{ $data->role }}) --}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                <div class="group-input">
                    <label for="description">Description</label>
                    <textarea name="description"></textarea>
                </div>
            </div> --}}
                            </div>
                        </div>
                        <div class="orig-head">
                            Document Information
                        </div>
                        <div class="input-fields">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-num">Document Number</label>
                                        <div class="default-name">Not available</div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="legacy_number">Legacy Document Number</label>
                                        <input type="text" id="legacy_number" name="legacy_number" maxlength="255">
                                    </div>
                                </div>

                                <div class="col-md-12">
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



                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="depart-name">Department Name<span class="text-danger">*</span></label>
                                        <select name="department_id" id="depart-name" required>
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach (Helpers::getDmsDepartments() as $code => $department)
                                                <option value="{{ $code }}">{{ $department }}</option>
                                            @endforeach
                                            {{-- @foreach ($departments as $department)
                                                <option data-id="{{ $department->dc }}" value="{{ $department->id }}">
                    {{ $department->name }}</option>
                    @endforeach --}}
                                        </select>
                                    </div>
                                    <p id="depart-nameError" style="color:red">** Department is required</p>
                                </div>


                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="depart-code">Department Code</label>
                                        <div class="default-name"> <span id="department-code">Not selected</span></div>
                                    </div>
                                </div> --}}
                                <div class="col-6">
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
                                    {{-- <p id="majorError" style="color:red">** Department is required</p> --}}
                                </div>

                                {{-- <div class="col-6">
                                        <div class="group-input">
                                            <label for="minor">Document Version <small>(Minor)</small><span class="text-danger">*</span>
                                                <span class="text-primary" data-bs-toggle="modal" data-bs-target="#document-management-system-modal-minor" style="font-size: 0.8rem; font-weight: 400;">
                                                    (Launch Instruction)
                                                </span>
                                            </label>
                                            <input type="number" name="minor" id="minor" min="0" max="9" required>

                                        </div>
                                    </div> --}}
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Type<span class="text-danger">*</span></label>
                                        <select name="document_type_id" id="doc-type" required>
                                            <option value="" selected>Enter your Selection</option>
                                            @foreach (Helpers::getDocumentTypes() as $code => $type)
                                                <option data-id="{{ $code }}" value="{{ $code }}">
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
                                        <div class="default-name"> <span id="document_type_code">Not selected</span></div>
                                    </div>
                                </div> --}}

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">Document Type<span class="text-danger">*</span></label>
                                        <select name="document_type_id" id="doc-type" required onchange="handleDocumentTypeChange(this)">
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
                                        <div class="default-name"> <span id="document_type_code">Not selected</span></div>
                                    </div>
                                </div>

                                <div class="col-md-6">
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-lang">Document Language Code</label>
                                        <div class="default-name"><span id="document_language">Not selected</span></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
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

                                <div class="col-md-5 new-date-data-field">
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

                                <div class="col-md-2 new-date-data-field">
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

                                <div class="col-md-5 new-date-data-field">
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

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="draft-doc">Attach Draft document</label>
                                        <input type="file" name="attach_draft_doocument">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="effective-doc">Attach Effective document</label>
                                        <input type="file" name="attach_effective_docuement">
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
                                       <label for="reviewers">Reviewers<span class="text-danger">*</span></label>
                                       <select id="reviewers-dropdown" class="form-control" name="reviewers[]" multiple required style="display: none">
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

                               <div class="col-md-6">
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
                                        <div><small class="text-primary"></small></div>
                                            <label for="action-plan-grid">
                                                    Revision History<button type="button" name="action-plan-grid"
                                                        id="Details_add_revision">+</button>
                                                <span class="text-primary" data-bs-toggle="modal"
                                                    data-bs-target="#observation-field-instruction-modal"
                                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                    Row Increment
                                                </span>
                                            </label>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="Details-table-revision">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 2%">Sr. No.</th>
                                                            <th style="width: 12%">Revision No.</th>
                                                            <th style="width: 12%">Change Control No./ DCRF No</th>
                                                            <th style="width: 12%">Effective Date</th>
                                                            <th style="width: 30%">Reason of revision</th>
                                                            <th style="width: 3%">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $serialNumber = 1;
                                                        @endphp
                                                        <td disabled>{{ $serialNumber++ }}</td>
                                                        <td><input type="text" name="revision_history[0][revision_number]"></td>
                                                        <td><input type="text" name="revision_history[0][cc_no]"></td>
                                                        <td><input type="text" name="revision_history[0][revised_effective_date]"></td>
                                                        <td><input type="text" name="revision_history[0][reason_of_revision]"></td>
                                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                                    </tbody>
                                                </table>
                                            </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        let investdetails = 1;
                                        $('#Details_add_revision').click(function(e) {
                                            function generateTableRow(serialNumber) {
                                                var users = @json($users);
                                                console.log(users);
                                                var html =
                                                        '<tr>' +
                                                        '<td><input disabled type="text" style ="width:15px" value="' + serialNumber +
                                                        '"></td>' +
                                                        '<td><input type="text" name="revision_history[' + investdetails +
                                                        '][revision_number]" value=""></td>' +
                                                        '<td><input type="text" name="revision_history[' + investdetails +
                                                        '][cc_no]" value=""></td>' +
                                                        '<td><input type="text" name="revision_history[' + investdetails +
                                                        '][revised_effective_date]" value=""></td>' +
                                                        '<td><input type="text" name="revision_history[' + investdetails +
                                                        '][reason_of_revision]" value=""></td>' +


                                                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                                                        '</tr>';


                                                    return html;
                                                }

                                                var tableBody = $('#Details-table-revision tbody');
                                                var rowCount = tableBody.children('tr').length;
                                                var newRow = generateTableRow(rowCount + 1);
                                                tableBody.append(newRow);
                                            });
                                        });
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

    <!-----------------MASTER FINISHED PRODUCT SPECIFICATION Tab ---------------------->
                    <div id="doc-mfps" class="tabcontent">
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
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="doc-type">STP No<span class="text-danger">*</span></label>
                                        <input type="text" id="stp" name="stp_mfps_no" maxlength="255">
                                    </div>
                                </div> --}}

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
                                        <label for="doc-type">Specification No</label>
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
                    </script>

    <!-----------------STUDY REPORT Tab ---------------------->
                <div id="doc-study" class="tabcontent">
                        <div class="orig-head">
                            Study Report
                        </div>
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
                                                        <button class="btn btn-dark subSummaryAdd">+</button>
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
                                        <label for="conclusion" id="conclusion">
                                            Conclusion & Recommendation<button type="button" id="conclusionbtnadd"
                                                name="button">+</button>
                                            <div><small class="text-primary">Please insert "NA" in the data field if it
                                                    does not require completion</small></div>
                                        </label>

                                        <div id="conclusiondiv">
                                            <div class="singleConclusionBlock">
                                                <div class="row">
                                                    <div class="col-sm-10">
                                                        <textarea name="conclusion_and_recommendations[]" class="myclassname"></textarea>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button class="btn btn-dark subConclusionAdd">+</button>
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
                                        <label for="procedure">Attachment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea name="study_attachments" class="summernote">
                                    </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="button-block">
                            <button type="submit" value="save" name="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">Exit</a></button>
                        </div>
                </div>
             
                    
    <!-----------------Study Protocol Tab ---------------------->
                    <div id="doc-stprotocol" class="tabcontent">
                        <div class="orig-head">
                            Study Protocol
                        </div>
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


                    <!-- equipment report -->

                    <div id="doc-eqpreport" class="tabcontent">
                        <div class="orig-head">
                          Equipment Hold Time Study Report
                        </div>
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
                                                <div class="file-attachment-list" id="annex_fileattachement"></div>
                                    
                                                <div class="add-btn">
                                                    <label for="annex_I_gxp_attachment" style="cursor: pointer;">Add</label>
                                                    <input type="file" id="annex_I_gxp_attachment" name="file_attach[]" 
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

                            <div class="group-input">
                                    <label for="action-plan-grid">
                                        Details<button type="button" name="action-plan-grid"
                                                id="Details_add_gtp">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Row Increment
                                        </span>
                                    </label>
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table-gtp">
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

                                                <td><input type="text" name="gtp[0][test_gtp]"></td>
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
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
                                        '][test_gtp]" value=""></td>' +


                                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
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


                <!------------------------ RMSTP tab ------------------------------------>
                <div id="doc_rmstp" class="tabcontent">
                        <div class="orig-head">
                            RAW MATERIAL STANDARD TESTING PROCEDURE
                        </div>
                    <div class="input-fields">
                        <div class="row">


                            <div class="group-input">
                                    <label for="action-plan-grid">
                                        Details<button type="button" name="action-plan-grid"
                                                id="Details_add">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Row Increment
                                        </span>
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
                            </div>


                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="short-desc">STP No.</label>

                                    <input type="text" id="" name="stp_no">
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
                                <div class="">
                                  PRODUCT DETAILS
                                </div>  <br>
                                <div class="col-md-6">
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



                <!------------------------ Packing Material Specification - tab ------------------------------------>
                <div id="doc_pams" class="tabcontent">
                    <div class="orig-head">
                        PACKING MATERIAL SPECIFICATION
                        </div>
                    <div class="input-fields">
                        <div class="row">


                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Name of packing material</label>
                                        <textarea name="name_pack_material"></textarea>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Standard pack</label>
                                        <textarea name="standard_pack"></textarea>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Sampling plan</label>
                                        <textarea name="sampling_plan"></textarea>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Sampling Instructions</label>
                                        <textarea name="sampling_instruction"></textarea>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Sample for analysis </label>
                                        <textarea name="sample_analysis"></textarea>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Control Sample</label>
                                        <textarea name="control_sample"></textarea>
                                    </div>
                            </div>

                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Safety Precautions</label>
                                        <textarea name="safety_precaution"></textarea>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Storage condition</label>
                                        <textarea name="storage_condition"></textarea>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Approved Vendors</label>
                                        <textarea name="approved_vendor"></textarea>
                                    </div>
                            </div>

                            <div class="group-input">
                                    <label for="action-plan-grid">
                                        Details<button type="button" name="action-plan-grid"
                                                id="Details_add_data">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Row Increment
                                        </span>
                                    </label>
                                <div class="table-responsive">
                                        <table class="table table-bordered" id="Details-table-data">
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
                                            @php
                                                    $serialNumber = 1;
                                                @endphp
                                                <td disabled>{{ $serialNumber++ }}</td>

                                                <td><input type="text" name="packingtest[0][tests]"></td>
                                                <td><input type="text" name="packingtest[0][specification]"></td>
                                                <td><input type="text" name="packingtest[0][gtp_no]"></td>
                                                <td><button type="text" class="removeRowBtn">Remove</button></td>
                                            </tbody>

                                        </table>
                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                let investdetails = 1;
                                $('#Details_add_data').click(function(e) {
                                    function generateTableRow(serialNumber) {
                                        var users = @json($users);
                                        console.log(users);
                                        var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" style ="width:15px" value="' + serialNumber +
                                                '"></td>' +
                                                '<td><input type="text" name="packingtest[' + investdetails +
                                                '][tests]" value=""></td>' +

                                                '<td><input type="text" name="packingtest[' + investdetails +
                                                '][specification]" value=""></td>' +
                                                '<td><input type="text" name="packingtest[' + investdetails +
                                                '][gtp_no]" value=""></td>' +
                                                '<td><button type="text" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';


                                            return html;
                                        }

                                        var tableBody = $('#Details-table-data tbody');
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


                                <div class="group-input">
                                    <label for="action-plan-grid">
                                    For Finished product specification use below table<button type="button" name="action-plan-grid"
                                                id="addRowBtndata">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#observation-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            Row Increment
                                        </span>
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
                                        <label for="train-require">Reference Standard/General Testing Procédure No</label>
                                        <input type="text" name="Reference_Standard">
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
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">Specification No</label>
                                        <input type="text" name="specification_no">
                                    </div>
                            </div> --}}


                                <div class="col-12 sub-head">
                                        Summary of Results
                                </div>
                                <div class="group-input">
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
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('#ObservationAdd').click(function(e) {
                                        function generateTableRow(serialNumber) {
                                            var html =
                                                '<tr>' +
                                                '<td><input disabled type="text" name="summaryResult[' + serialNumber +
                                                '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                '<td><input type="text" name="summaryResult[' + serialNumber +
                                                '][job]"></td>' +
                                                '<td><input type="text" name="summaryResult[' + serialNumber +
                                                '][remarks]"></td>' +
                                                '</tr>';
                                    return html;
                                }

                                        var tableBody = $('#job-responsibilty-table tbody');
                                        var lastIndex = 0;

                                        // Check last row index from existing rows
                                        tableBody.find('tr').each(function() {
                                            var inputName = $(this).find('input[name^="summaryResult["]').attr('name');
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

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="procedure">B) Test wise data and calculation:-</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea name="procedure" class="summernote">
                                </textarea>
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
                            {{-- <div class="col-md-12">
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
                            </div> --}}

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
                                                        <td><input type="date" name="sampleReconcilation[0][used_by]"></td>
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
                                                        '<td><input type="date" class="Document_Remarks" name="sampleReconcilation[' +
                                                        serialNumber + '][used_by]"></td>' +
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

                                <div class="col-md-6">
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

                    {{-- Finished product,  Inprocess , Cleaning Validation Specification (Commercial  registration , re-registration) tabs --}}

                    <div id="doc_FPS" class="tabcontent">
                        <div class="orig-head">FINISHED PRODUCT  VALIDATION SPECIFICATION
                            (COMMERCIAL / REGISTRATION / RE-REGISTRATION)
                        </div>
                        <div class="input-fields">
                            <div class="row">
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Label Claim</label>
                                        <input type="text" name="label_claim">
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
                                        <input type="text" name="storage_condition">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity">
                                            <option value="" selected>Enter your Selection</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>

                                        </select>
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
                                </div>
                                <div class="col-12">
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
                                </div>
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
                            <div class="col-12 sub-head">
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
                            </div>
                            <script>
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


                    {{-- protocal and crump tabs  --}}
                        <div class="orig-head">PROTOCOL CUM REPORT
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


 {{-- temperature mapping protcal tabs  --}}

 <div id="doc-tempmapping" class="tabcontent">
    <div class="orig-head">
        Temperature Mapping Protocal
    </div>
    <div class="input-fields">
        <div class="row">

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
{{-- hold study report tabs  --}}

<div id="doc-holdtimstduy" class="tabcontent">
    <div class="orig-head">
        Hold Time Study Report
    </div>
    <div class="input-fields">
        <div class="row">

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

            {{-- <div class="col-md-12">
                <div class="group-input">

                    <label for="CalibrationQualificationStatus_HoTiStRe" id="CalibrationQualificationStatus_HoTiStRe">
                        Calibration And Qualification Status<button type="button" id="CalibrationQualificationStatus_HoTiStRebtnadd"
                            name="button">+</button>
                        <div><small class="text-primary">Please insert "NA" in the data field if it
                                does not require completion</small></div>
                    </label>

                    <div id="CalibrationQualificationStatus_HoTiStRediv">
                        <div class="singleCalibrationQualificationStatus_HoTiStReBlock">
                            <div class="row">
                                <div class="col-sm-10">
                                    <textarea name="CalibrationQualificationStatus_HoTiStRe[]" class="myclassname"></textarea>
                                </div>
                                <div class="col-sm-1">
                                    <button class="btn btn-dark subCalibrationQualificationStatus_HoTiStReAdd">+</button>
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


            <!-- Cleaning Validation Specification -->
                    <div id="doc_CVS" class="tabcontent">
                        <div class="orig-head">
                            (COMMERCIAL / REGISTRATION / RE-REGISTRATION)
                        </div>

                        <div class="input-fields">
                            <div class="row">
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Label Claim</label>
                                        <input type="text" name="label_claim_cvs">
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity_cvs">
                                            <option value="" selected>Enter your Selection</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>

                                        </select>
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

                                <div class="col-12 sub-head">
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
                                                    <!-- Initial Row Placeholder (Optional) -->
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
                                </script>
                            <div class="col-12 sub-head">
                                Validation  Specification
                            </div>
                            <div class="col-12">
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
                            </div>
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
                            (COMMERCIAL / REGISTRATION / RE-REGISTRATION)
                        </div>
                        <div class="input-fields">
                            <div class="row">
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="label-claim">Label Claim</label>
                                        <input type="text" name="label_claim_inps">
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity_inps">
                                            <option value="" selected>Enter your Selection</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>

                                        </select>
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

                                <div class="col-12 sub-head">
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
                                </script>
                            <div class="col-12 sub-head">
                                Validation  Specification
                            </div>
                            <div class="col-12">
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
                            </div>
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


                    {{-- Finished product,  Inprocess,  Cleaning Validation Standard Testing Procedure (Commercial  registration , re-registration) TABS --}}

                    <div id="doc-fpstp" class="tabcontent">
                        <div class="orig-head">
                            FINISHED PRODUCT ON STANDARD TESTING PROCEDURE (COMMERCIAL / REGISTRATION / RE-REGISTRATION)
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
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
                                                <!-- Initial Row Placeholder (Optional) -->
                                                <tr>
                                                    <td><input disabled type="text" name="finished_product[0][serial]" value="1"></td>
                                                    <td><input type="text" name="finished_product[0][testing]"></td>
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

                    <div id="doc-istp" class="tabcontent">
                        <div class="orig-head">
                            INPROCESS STANDARD TESTING PROCEDURE (COMMERCIAL / REGISTRATION / RE-REGISTRATION)
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
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
                                    // Add new row in Specification Details table
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

                    <div id="doc-cvstp" class="tabcontent">
                        <div class="orig-head">
                            CLEANING VALIDATION STANDARD TESTING PROCEDURE (COMMERCIAL / REGISTRATION / RE-REGISTRATION)
                        </div>
                        <div class="input-fields">
                            <div class="row">

                            <!-- <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div> -->
                            <div class="col-12">
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
                                                <!-- Initial Row Placeholder (Optional) -->
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
                                    // Add new row in Specification Details table
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

                    {{-- Hold Time Study Protocol Tabs --}}
                    <div id="doc-htsp" class="tabcontent">
                        <div class="orig-head">
                            Hold Time Study Protocol</div>
                            <div class="input-fields">
                                <div class="row">
                                    <div class="col-md-12">
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
                                    </div>

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
    
                                    <div class="col-md-12">
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
    
    
                                    <div class="col-md-12">
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
    
    
    
                                    <div class="col-md-12">
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
                                    </div>


    
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

                    {{-- Raw Material Specifications Tabs --}}
                    <div id="doc-rawms" class="tabcontent">
                        <div class="orig-head">
                            RAW MATERIAL SPECIFICATION</div>
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
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sampling-procedure">Sampling Procedure</label>
                                        <input type="text" name="sampling_procedure_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="item-code">Item Code</label>
                                        <input type="text" name="item_code_row_material">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="sample-quantity">Sample Quantity for Analysis</label>
                                        <select name="sample_quantity_row_material">
                                            <option value="" selected>--Select--</option>
                                            <option value="Chemical Analysis">Chemical Analysis</option>
                                            <option value="Microbial Analysis">Microbial Analysis</option>
                                        </select>
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


                            <div class="col-12 sub-head">
                                STANDARD TESTING PROCEDURE
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Specification Details">
                                        STANDARD TESTING PROCEDURE
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
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Originated By
                                        {{-- Review Proposed By --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Review Proposed On
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Originated On
                                        {{-- Document Reuqest Approved By --}}
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Document Reuqest Approved On
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Document Writing Completed By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Document Writing Completed On
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Reviewd By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Reviewd On
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Approved By
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="review-names">
                                    <div class="orig-head">
                                        Approved On
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

    <script>
        var maxLength = 255;
        $('#docname').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#rchars').text(textlen);
        });
    </script>
    <script>
        var maxLength = 255;
        $('#short_desc').keyup(function() {
            var textlen = maxLength - $(this).val().length;
            $('#new-rchars').text(textlen);
        });
    </script>

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
