@extends('frontend.layout.main')
@section('container')

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
                <button class="tablinks hidden-tabs" data-id="INPS" onclick="openData(event, 'add-fpicvs')">Inprocess Specification</button>
                <button class="tablinks hidden-tabs" data-id="CVS" onclick="openData(event, 'doc_CVS')">Cleaning Validation Specification</button>

                <button class="tablinks hidden-tabs" data-id="FPSTP" onclick="openData(event, 'doc-fpstp')">Finished Product Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="INPSTP" onclick="openData(event, 'doc-istp')">Inprocess Standard Testing Procedure</button>
                <button class="tablinks hidden-tabs" data-id="CVSTP" onclick="openData(event, 'doc-cvstp')">Cleaning Validation Standard Testing Procedure</button>
                
                <button class="tablinks hidden-tabs" data-id="TEMPMAPPING" onclick="openData(event, 'doc-tempmapping')">Temperature Mapping Report</button>

                <button class="tablinks hidden-tabs" data-id="RAWMS" onclick="openData(event, 'doc-rawms')">RAWMS SOP</button>

                <button class="tablinks hidden-tabs" data-id="RMSTP" onclick="openData(event, 'doc_rmstp')">RMSTP SOP</button>
                <button class="tablinks hidden-tabs" data-id="PAMS" onclick="openData(event, 'doc_pams')">Packing Material Specification</button>
                <button class="tablinks hidden-tabs" data-id="PROVALIPROTOCOL" onclick="openData(event, 'doc_prvp')">Process Validation Protocol</button>

                <button class="tablinks hidden-tabs" data-id="PIAS" onclick="openData(event, 'doc_pias')">Product / Item Information-Addendum Specification</button>
                <button class="tablinks hidden-tabs" data-id="TDS" onclick="openData(event, 'doc-tds')">TDS</button>
                <button class="tablinks hidden-tabs" data-id="GTP" onclick="openData(event, 'doc-gtp')">GTP</button>
                <button class="tablinks hidden-tabs" data-id="MFPS" onclick="openData(event, 'doc-mfps')">MFPS</button>
                <button class="tablinks hidden-tabs" data-id="MFPSTP" onclick="openData(event, 'doc-mfpstp')">MFPSTP</button>
                <button class="tablinks hidden-tabs" data-id="MFPSTP" onclick="openData(event, 'doc-mfpstp')">MFPSTP</button>
                <button class="tablinks hidden-tabs" data-id="STUDY" onclick="openData(event, 'doc-study')">Study Report</button>

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

                                {{-- @php
            use Illuminate\Support\Facades\DB;

            $actionItems = DB::table('action_items')->get();
        @endphp

        <div class="col-md-6">
            <div class="group-input">
                <label for="link-doc">Parent Child Record</label>
                <select multiple name="parent_child[]" placeholder="Select Parent Child Records" data-search="false" data-silent-initial-value-set="true" id="parent_child">
                    @foreach ($actionItems as $item)
                        <option value="{{ $item->id }}">
                            {{ Helpers::getDivisionName(session()->get('division')) }}/AI/{{ date('Y') }}/{{ $item->record}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div> --}}

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
                                        <select id="choices-multiple-remove-button" class="choices-multiple-reviewer"
                                            name="reviewers[]" placeholder="Select Reviewers" multiple required>
                                            @if (!empty($reviewer))
                                                @foreach ($reviewer as $lan)
                                                    @if (Helpers::checkUserRolesreviewer($lan))
                                                        <option value="{{ $lan->id }}">
                                                            {{ $lan->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                    <p id="reviewerError" style="color:red">** Reviewers are required</p>

                                </div>
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="approvers">Approvers<span class="text-danger">*</span></label>
                                        <select id="choices-multiple-remove-button" class="choices-multiple-reviewer"
                                            name="approvers[]" placeholder="Select Approvers" multiple required>
                                            @if (!empty($approvers))
                                                @foreach ($approvers as $lan)
                                                    @if (Helpers::checkUserRolesApprovers($lan))
                                                        <option value="{{ $lan->id }}">
                                                            {{ $lan->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <p id="approverError" style="color:red">** Approvers are required</p>

                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="hods">HOD's<span class="text-danger">*</span></label>
                                        <select id="choices-multiple-remove-button" class="choices-multiple-reviewer"
                                            name="hods[]" placeholder="Select HOD's" multiple required>
                                            @foreach ($hods as $hod)
                                                <option value="{{ $hod->id }}">
                                                    {{ $hod->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <p id="hodError" style="color:red">** HOD's are required</p> --}}

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
                                </div>

                {{-- <div class="col-md-12">
                <div class="group-input">
                    <label for="test">
                        Revision History<button type="button" name="reporting2" onclick="addRevRow('revision')">+</button>
                    </label>
                    <div><small class="text-primary">Please mention brief summary</small></div>
                    <table class="table-bordered table" id="revision">
                        <thead>
                            <tr>
                                <th class="sop-num">SOP Revision No.</th>
                                <th class="dcrf-num">Change Control No./ DCRF No.</th>
                                <th class="changes">Changes</th>
                                <th class="deleteRow">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" id="rev-num0"></td>
                                <td><input type="text" id="control0"></td>
                                <td><input type="text" id="change0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}
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

                                {{-- <div class="col-md-12">
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
                                </div> --}}

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
                                </div>


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


                {{-- <div class="col-md-12">
                <div class="group-input">
                    <label for="test">
                        Revision History<button type="button" name="reporting2" onclick="addRevRow('revision')">+</button>
                    </label>
                    <div><small class="text-primary">Please mention brief summary</small></div>
                    <table class="table-bordered table" id="revision">
                        <thead>
                            <tr>
                                <th class="sop-num">SOP Revision No.</th>
                                <th class="dcrf-num">Change Control No./ DCRF No.</th>
                                <th class="changes">Changes</th>
                                <th class="deleteRow">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" id="rev-num0"></td>
                                <td><input type="text" id="control0"></td>
                                <td><input type="text" id="change0"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}
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



                <div id="doc_prvp" class="tabcontent">
                    <div class="orig-head">
                        PROCESS VALIDATION PROTOCOL 
                        </div>
                    <div class="input-fields">
                        <div class="row">
                            
                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="purpose">Purpose</label>
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
                                        <textarea name="validation_po" class="summernote">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="group-input">
                                        <label for="scope">Description of SOP</label>
                                        <textarea name="description_sop"></textarea>
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
                                        <label for="abbreviation" id="definition">
                                        Rationale for selection of critical steps<button type="button" id="Definitionbtnadd"
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
                                {{-- <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">TDS No.</label>
                                        <input type="text" name="tds_no">
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="train-require">Reference Standard/General Testing Procédure No</label>
                                        <input type="text" name="Reference_Standard">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="batch_no">Batch No</label>
                                        <input type="text" name="batch_no">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="group-input">
                                        <label for="ar_no">A.R. No.</label>
                                        <input type="text" name="ar_no">
                                    </div>
                                </div>


                                <div class="col-md-6">
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
                                </div>


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

                            <div class="col-md-12">
                                <div class="group-input">
                                    <label for="tds_remark">Remark</label>
                                    <textarea name="tds_remark"></textarea>
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
                        <div class="orig-head">FINISHED PRODUCT / INPROCESS / CLEANING VALIDATION SPECIFICATION
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

    <!-- Cleaning Validation Specification -->

    <div id="doc_CVS" class="tabcontent">
                        <div class="orig-head">FINISHED PRODUCT / INPROCESS / CLEANING VALIDATION SPECIFICATION
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
