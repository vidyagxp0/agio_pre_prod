@extends('frontend.layout.main')
@section('container')
    <style>
        textarea.note-codable {
            display: none !important;
        }

        header {
            display: none;
        }
    </style>

    @php
        $users = DB::table('users')->get();
    @endphp
    <div class="form-field-head">
        {{-- <div class="pr-id">
            New Child
        </div> --}}
        <div class="division-bar">
            <strong>Site Division/Project</strong> :
            {{ Helpers::getDivisionName(session()->get('division')) }}/ Market Complaint
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#Monitor_Information').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="date" name="date[]"></td>' +
                        ' <td><input type="text" name="Responsible[]"></td>' +
                        '<td><input type="text" name="ItemDescription[]"></td>' +
                        '<td><input type="date" name="SentDate[]"></td>' +
                        '<td><input type="date" name="ReturnDate[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Monitor_Information_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#Product_Material').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="ProductName[]"></td>' +
                        '<td><input type="number" name="ReBatchNumber[]"></td>' +
                        '<td><input type="date" name="ExpiryDate[]"></td>' +
                        '<td><input type="date" name="ManufacturedDate[]"></td>' +
                        '<td><input type="text" name="Disposition[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Product_Material_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#Equipment').click(function(e) {
                function generateTableRow(serialNumber) {


                    var html =
                        '<tr>' +
                        '<td><input disabled type="text" name="serial[]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="ProductName[]"></td>' +
                        '<td><input type="number" name="BatchNumber[]"></td>' +
                        '<td><input type="date" name="ExpiryDate[]"></td>' +
                        '<td><input type="date" name="ManufacturedDate[]"></td>' +
                        '<td><input type="number" name="NumberOfItemsNeeded[]"></td>' +
                        '<td><input type="text" name="Exist[]"></td>' +
                        '<td><input type="text" name="Comment[]"></td>' +


                        '</tr>';

                    // for (var i = 0; i < users.length; i++) {
                    //     html += '<option value="' + users[i].id + '">' + users[i].name + '</option>';
                    // }

                    // html += '</select></td>' +

                    //     '</tr>';

                    return html;
                }

                var tableBody = $('#Equipment_details tbody');
                var rowCount = tableBody.children('tr').length;
                var newRow = generateTableRow(rowCount + 1);
                tableBody.append(newRow);
            });
        });
    </script>

    <script>
        function handleDateInput(input, targetId) {
            const target = document.getElementById(targetId);
            const date = new Date(input.value);
            const options = {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            };
            const formattedDate = date.toLocaleDateString('en-US', options).replace(/ /g, '-');
            target.value = formattedDate;
        }
    </script>












    {{-- ! ========================================= --}}
    {{-- !               DATA FIELDS                 --}}
    {{-- ! ========================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Complaint Acknowledgement</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">QA/CQA Head Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Preliminary Investigation </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CFT Review</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Verification by QA/CQA</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">QA/CQA Head Approval</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Closure</button>

                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Signature</button>

            </div>

            <form action="{{ route('marketcomplaint.mcstore') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="step-form">
                    @if (!empty($parent_id))
                        <input type="hidden" name="parent_id" value="{{ $parent_id }}">
                        <input type="hidden" name="parent_type" value="{{ $parent_type }}">
                    @endif
                    <!-- Tab content -->
                    <div id="CCForm1" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <!-- RECORD NUMBER -->
                            <div class="row">
                                <div class="sub-head">
                                    General Information
                                </div>
                                @php
                                    $getDiv = Helpers::getDivisionName(session()->get('division'));
                                    // $substract = strtoupper(Str::substr($getDiv, 0, 2));
                                @endphp
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="RLS Record Number"><b>Record Number</b></label>
                                        <input disabled type="text" name="record" id="record"
                                            value="{{ $getDiv }}/MC/{{ date('Y') }}/{{ str_pad($record, 4, '0', STR_PAD_LEFT) }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label disabled for="Short Description">Division Code<span
                                                class="text-danger"></span></label>
                                        <input disabled type="text" name="division_code"
                                            value="{{ Helpers::getDivisionName(session()->get('division')) }}">
                                        <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="originator">Initiator</label>
                                        <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}" />
                                    </div>
                                </div>

                                <div class="col-md-6 ">
                                    <div class="group-input ">
                                        <label for="due-date"> Date Of Initiation<span class="text-danger"></span></label>
                                        <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                                        <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Assigned to">Assigned To   </label>
                                        <select name="assign_to">
                                            <option value="">-- Select --</option>
                                            @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Short Description">Short Description<span
                                                class="text-danger">*</span></label>
                                        <span id="rchars">255</span> Characters remaining

                                        <input name="description_gi" id="docname" maxlength="255" required>

                                    </div>
                                </div>

                                {{-- <div class="col-md-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="due-date">Due Date <span class="text-danger"></span></label>
                                        <div class="calenderauditee">
                                            <!-- Display the formatted date in a readonly input -->
                                            <input type="text" id="due_date_display" readonly placeholder="DD-MMM-YYYY"
                                                value="{{ Helpers::getDueDate(30, true) }}" />

                                            <input type="date" name="due_date_gi"
                                                min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                value="{{ Helpers::getDueDate(30, false) }}" class="hide-input" readonly />
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Scheduled Start Date">Due Date</label>
                                        <div class="calenderauditee">
                                            <input type="text" id="due_date_gi" readonly placeholder="DD-MMM-YYYY"
                                                value="" />
                                            <input type="date" id="due_date_checkdate" value="" name="due_date_gi"
                                                min="" class="hide-input"
                                                oninput="handleDateInput(this, 'due_date_gi');" />
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    function calculateDueDate() {
                                        const initiationDateInput = document.getElementById('intiation_date');
                                        const deviationCategorySelect = document.getElementById('Deviation_category');
                                        const dueDateInput = document.getElementById('due_date_gi');

                                        if (initiationDateInput.value && deviationCategorySelect.value) {
                                            const initiationDate = new Date(initiationDateInput.value);
                                            let dueDate = new Date(initiationDate);

                                            switch (deviationCategorySelect.value) {
                                                case 'minor':
                                                    dueDate.setDate(dueDate.getDate() + 15);
                                                    break;
                                                case 'major':
                                                    dueDate.setDate(dueDate.getDate() + 30);
                                                    break;
                                                case 'critical':
                                                    dueDate.setDate(dueDate.getDate() + 30);
                                                    break;
                                                default:
                                                    dueDate = null;
                                                    break;
                                            }

                                            if (dueDate) {
                                                const day = String(dueDate.getDate()).padStart(2, '0');
                                                const monthNames = [
                                                    'January', 'February', 'March', 'April', 'May', 'June',
                                                    'July', 'August', 'September', 'October', 'November', 'December'
                                                ];
                                                const month = monthNames[dueDate.getMonth()];
                                                const year = dueDate.getFullYear();
                                                dueDateInput.value = `${day}-${month}-${year}`;
                                            }
                                        }
                                    }

                                    document.getElementById('intiation_date').addEventListener('change', calculateDueDate);
                                    document.getElementById('Deviation_category').addEventListener('change', calculateDueDate);
                                </script>


                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group"><b>Initiator Department</b></label>
                                        <select name="initiator_group" id="initiator_group">
                                            <option value="">-- Select --</option>
                                            <optio value="">Select Initiation Department</option>
                                                <option value="CQA" >Corporate Quality Assurance</option>
                                                <option value="QA" >Quality Assurance</option>
                                                <option value="QC" >Quality Control</option>
                                                <option value="QM" >Quality Control (Microbiology department)</option>
                                                <option value="PG" >Production General</option>
                                                <option value="PL" >Production Liquid Orals</option>
                                                <option value="PT" >Production Tablet and Powder</option>
                                                <option value="PE" >Production External (Ointment, Gels, Creams and Liquid)</option>
                                                <option value="PC" >Production Capsules</option>
                                                <option value="PI" >Production Injectable</option>
                                                <option value="EN" >Engineering</option>
                                                <option value="HR" >Human Resource</option>
                                                <option value="ST" >Store</option>
                                                <option value="IT" >Electronic Data Processing</option>
                                                <option value="FD" >Formulation  Development</option>
                                                <option value="AL" >Analytical research and Development Laboratory</option>
                                                <option value="PD">Packaging Development</option>
                                                <option value="PU">Purchase Department</option>
                                                <option value="DC">Document Cell</option>
                                                <option value="RA">Regulatory Affairs</option>
                                                <option value="PV">Pharmacovigilance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group Code">Initiator Department Code</label>
                                        <input type="text" name="initiator_group_code_gi" id="initiator_group_code_gi"
                                            value="" readonly>
                                    </div>
                                </div>


                                <script>
                                    // JavaScript
                                    document.getElementById('initiator_group').addEventListener('change', function() {
                                        var selectedValue = this.value;
                                        document.getElementById('initiator_group_code_gi').value = selectedValue;
                                    });
                                </script>

                                <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        const options = {
                                            day: '2-digit',
                                            month: 'short',
                                            year: 'numeric'
                                        };
                                        document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }

                                    // Call this function initially to ensure the correct format is shown on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date_gi"]');
                                        handleDateInput(dateInput, 'due_date_display');
                                    });
                                </script>

                                <style>
                                    .hide-input {
                                        display: none;
                                    }
                                </style>



                                {{-- <script>
                                    function handleDateInput(dateInput, displayId) {
                                        const date = new Date(dateInput.value);
                                        const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                        document.getElementById(displayId).value = date.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }

                                    // Call this function initially to ensure the correct format is shown on page load
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const dateInput = document.querySelector('input[name="due_date"]');
                                        handleDateInput(dateInput, 'due_date_display');
                                    });
                                    </script>

                                    <style>
                                    .hide-input {
                                        display: none;
                                    }
                                    </style> --}}

                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Initiated Through</label>
                                        <div><small class="text-primary">Please select related information</small></div>
                                        <select name="initiated_through_gi" onchange="">
                                            <option value="">-- select --</option>
                                            <option value="recall">Recall</option>
                                            <option value="return">Return</option>
                                            <option value="deviation">Deviation</option>
                                            <option value="complaint">Complaint</option>
                                            <option value="regulatory">Regulatory</option>
                                            <option value="lab-incident">Lab Incident</option>
                                            <option value="improvement">Improvement</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </div>
                                </div> --}}

                                {{-- <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="If Other">If Other</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea  name="if_other_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div> --}}


                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">Information Attachment</label>
                                        <div>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_gi">


                                            </div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_gi"
                                                    name="initial_attachment_gi[]"
                                                    oninput="addMultipleFiles(this,'initial_attachment_gi')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Complainant</label>
                                        <select id="select-state" placeholder="Select..." name="complainant_gi">
                                            <option value="">Select a value</option>
                                            @foreach ($users as $value)
                                                <option value="{{ $value->name }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('assign_to')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- ===changes according client requerement ======= --}}
                                <div class="col-lg-6">
                                    <div class="group-input">
                                        <label for="Initiator Group">Complaint</label>
                                        <input type="text" name="complainant_gi">

                                    </div>
                                </div>



                                <div class="col-lg-6 new-date-data-field">
                                    <div class="group-input input-date">
                                        <label for="Due Date">Complaint Reported On</label>

                                        <div class="calenderauditee">
                                            <input type="text" id="complaint_dat" name="complaint_reported_on_gi" placeholder="Select Due Date" value=""/>
                                        </div>
                                        <script>
                                            $(document).ready(function() {
                                                $("#complaint_dat").datepicker({
                                                    dateFormat: "dd-M-yy",
                                                    // Do not set a default date, let the user select it
                                                    onClose: function(dateText, inst) {
                                                        if (!dateText) {
                                                            $(this).val('');  // Ensure input stays empty if no date is selected
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                    </div>
                                </div>


                                {{-- <script>
                                    document.addEventListener('DOMContentLoaded', (event) => {
                                        const dateInput = document.getElementById('complaint_date_picker');
                                        const today = new Date().toISOString().split('T')[0];
                                        dateInput.setAttribute('max', today);

                                        // Show the date picker when clicking on the readonly input
                                        const readonlyInput = document.getElementById('complaint_dat');
                                        readonlyInput.addEventListener('click', () => {
                                            dateInput.style.display = 'block';
                                            dateInput.focus();
                                        });

                                        // Update the readonly input when a date is selected
                                        dateInput.addEventListener('change', () => {
                                            const selectedDate = new Date(dateInput.value);
                                            const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                            readonlyInput.value = selectedDate.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                            dateInput.style.display = 'none';
                                        });
                                    });

                                    function handleDateInput(dateInput, readonlyInputId) {
                                        const readonlyInput = document.getElementById(readonlyInputId);
                                        const selectedDate = new Date(dateInput.value);
                                        const options = { day: '2-digit', month: 'short', year: 'numeric' };
                                        readonlyInput.value = selectedDate.toLocaleDateString('en-GB', options).replace(/ /g, '-');
                                    }
                                </script> --}}

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Details Of Nature Market Complaint">Details Of Nature Market
                                            Complaint</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="details_of_nature_market_complaint_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Product Details
                                            <button type="button" id="product_details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="product_details_details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Product Name</th>
                                                        <th>Batch No.</th>
                                                        <th>Mfg. Date</th>
                                                        <th>Exp. Date</th>
                                                        <th>Batch Size</th>
                                                        <th>Pack Size</th>
                                                        <th>Dispatch Quantity</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text"
                                                                name="serial_number_gi[0][serial]" value="1"></td>
                                                        <td><input type="text"
                                                                name="serial_number_gi[0][info_product_name]"></td>
                                                        <td><input type="text"
                                                                name="serial_number_gi[0][info_batch_no]"></td>

                                                        <td>
                                                            <div class="new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input id="date_0_date_display" type="text"
                                                                            name="serial_number_gi[0][info_mfg_date]"
                                                                            placeholder="DD-MMM-YYYY" value=""
                                                                            readonly onclick="document.getElementById('date_0_date_input').click();" />
                                                                        <!-- Hidden date input field for actual date handling -->
                                                                        <input type="date"
                                                                            name="serial_number_gi[0][info_mfg_date]"
                                                                            min="{{ today()->subDays(1000)->format('Y-m-d') }}"
                                                                            {{-- max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" --}}
                                                                            value=""
                                                                            id="date_0_date_input"
                                                                            class="hide-input show_date"
                                                                            style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                            onchange="handleDateInput(this, 'date_0_date_display')" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input id="date_0_expiry_date_display" type="text"
                                                                            name="serial_number_gi[0][info_expiry_date]"
                                                                            placeholder="DD-MMM-YYYY" value=""
                                                                            readonly onclick="document.getElementById('date_0_expiry_date_input').click();" />
                                                                        <!-- Hidden date input field for actual date handling -->
                                                                        <input type="date"
                                                                            name="serial_number_gi[0][info_expiry_date]"
                                                                            value=""
                                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                            id="date_0_expiry_date_input"
                                                                            class="hide-input show_date"
                                                                            style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                            onchange="handleDateInput(this, 'date_0_expiry_date_display')" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        {{-- <td><input type="text" name="serial_number_gi[0][info_expiry_date]" placeholder="DD-MMM-YYYY"></td> --}}
                                                        <td><input type="text"
                                                                name="serial_number_gi[0][info_batch_size]"></td>
                                                        <td><input type="text"
                                                                name="serial_number_gi[0][info_pack_size]"></td>
                                                        <td><input type="text"
                                                                name="serial_number_gi[0][info_dispatch_quantity]"></td>
                                                        <td><input type="text"
                                                                name="serial_number_gi[0][info_remarks]"></td>
                                                        <td><button type="button" class="removeRowBtn">Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });

                                    $(document).ready(function() {
                                        $('#product_details').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="serial_number_gi[' + serialNumber + '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_product_name]"></td>' +
                                                    '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_batch_no]"></td>' +
                                                    // '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_mfg_date]" placeholder="DD-MMM-YYYY"></td>' +
                                                    // '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_expiry_date]" placeholder="DD-MMM-YYYY"></td>' +
                                                    '<td> <div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee"><input id="date_' +  serialNumber + '_info_mfg_date" type="text" readonly name="serial_number_gi[' + serialNumber + '][info_mfg_date]" placeholder="DD-MMM-YYYY" /> <input type="date" name="serial_number_gi[' +  serialNumber + '][info_mfg_date]" min="{{ today()->subDays(1000)->format('Y-m-d') }}" value="" id="date_' +  serialNumber +  '_info_mfg_date" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_' +  serialNumber + '_info_mfg_date\')" /> </div></div></div> </td>' +
                                                    '<td> <div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee"><input id="date_' + serialNumber + '_info_expiry_date" type="text" name="serial_number_gi[' + serialNumber + '][info_expiry_date]" placeholder="DD-MMM-YYYY" /> <input type="date" name="serial_number_gi[' +  serialNumber + '][info_expiry_date]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  value="" id="date_' + serialNumber +  '_info_expiry_date" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_' + serialNumber + '_info_expiry_date\')" /> </div></div></div> </td>' +
                                                    '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_batch_size]"></td>' +
                                                    '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_pack_size]"></td>' +
                                                    '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_dispatch_quantity]"></td>' +
                                                    '<td><input type="text" name="serial_number_gi[' + serialNumber + '][info_remarks]"></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#product_details_details tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                                    <script>
                                        function handleDateInput(dateInput, textInputId) {
                                            const selectedDate = new Date(dateInput.value);
                                            const today = new Date();

                                            // Remove the time portion of today's date for comparison
                                            today.setHours(0, 0, 0, 0);

                                            if (selectedDate < today) {
                                                alert("Selected date is in the past. Please choose a current or future date.");
                                                dateInput.value = "";
                                                document.getElementById(textInputId).value = "";
                                            } else {
                                                const formattedDate = selectedDate.toLocaleDateString('en-GB', {
                                                    day: '2-digit', month: 'short', year: 'numeric'
                                                }).replace(/ /g, '-');
                                                document.getElementById(textInputId).value = formattedDate;
                                            }
                                        }

                                        // Set minimum date for date inputs to today
                                        document.querySelectorAll('input[type="date"]').forEach(input => {
                                            // input.setAttribute('min', new Date().toISOString().split('T')[0]);
                                        });
                                    </script>


                                {{-- {{ ---end s code }} --}}
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Traceability
                                            <button type="button" id="traceblity_add">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="traceblity" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Product Name</th>
                                                        <th>Batch No.</th>
                                                        <th>Manufacturing Location</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text" name="trace_ability[0][serial]"
                                                                value="1"></td>
                                                        <td><input type="text"
                                                                name="trace_ability[0][product_name_tr]"></td>
                                                        <td><input type="text" name="trace_ability[0][batch_no_tr]">
                                                        </td>
                                                        <td><input type="text"
                                                                name="trace_ability[0][manufacturing_location_tr]"></td>
                                                        <td><input type="text" name="trace_ability[0][remarks_tr]">
                                                        </td>
                                                        <td><button type="text" class="removeRowBtn">Remove</button>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    })
                                </script>


                                <script>
                                    $(document).ready(function() {
                                        $('#traceblity_add').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="trace_ability[' + serialNumber +
                                                    '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="trace_ability[' + serialNumber +
                                                    '][product_name_tr]"></td>' +
                                                    '<td><input type="text" name="trace_ability[' + serialNumber +
                                                    '][batch_no_tr]"></td>' +
                                                    '<td><input type="text" name="trace_ability[' + serialNumber +
                                                    '][manufacturing_location_tr]"></td>' +
                                                    '<td><input type="text" name="trace_ability[' + serialNumber +
                                                    '][remarks_tr]"></td>' +
                                                    '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +

                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#traceblity tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Categorization of complaint</label>
                                        <select name="categorization_of_complaint_gi" onchange="">
                                            <option value="">-- select --</option>
                                            <option value="Critical">Critical</option>
                                            <option value="Critical">Major</option>
                                            <option value="Critical">Minor</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="is_repeat_gi">Is Repeat</label>
                                        <select name="is_repeat_gi" id="is_repeat_gi">
                                            <option value="">-- select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3" id="repeat_nature_div" style="display: none;">
                                    <div class="group-input">
                                        <label for="repeat_nature_gi">Repeat Nature</label>
                                        <div>
                                            <small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small>
                                        </div>
                                        <textarea name="repeat_nature_gi" id="repeat_nature_gi"></textarea>
                                    </div>
                                </div>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        // Handle the change event for the select element
                                        var isRepeatSelect = document.getElementById('is_repeat_gi');
                                        var repeatNatureDiv = document.getElementById('repeat_nature_div');

                                        isRepeatSelect.addEventListener('change', function() {
                                            if (isRepeatSelect.value === 'yes') {
                                                repeatNatureDiv.style.display = 'block';
                                            } else {
                                                repeatNatureDiv.style.display = 'none';
                                            }
                                        });
                                    });
                                </script>



                                {{-- <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Initiator Group">Is Repeat</label>
                                        <select name="is_repeat_gi" onchange="">
                                            <option value="">-- select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>


                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Repeat Nature">Repeat Nature</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="repeat_nature_gi" id="summernote-1">

                                    </textarea>
                                    </div>
                                </div> --}}

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Complaint Sample">Review of Complaint Sample</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_complaint_sample_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Control Sample">Review of Control Sample</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_control_sample_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of stability study program and samples">Review of stability study program and samples</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_stability_study_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of product manufacturing and analytical process">Review of product manufacturing and analytical process </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_product_manu_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="group-input">
                                        <label for="Additional information if require ">Additional information if require</label>
                                        <select name="additional_inform" id="additional_inform">
                                            <option value="">-- select --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="In case of Invalide complain then">In case of Invalide complain then </label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="in_case_Invalide_com" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Report Review (Final Review shall be done after QA Verification) 
                                            <button type="button" id="team_members_details">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="team_members_details_add"
                                                style="width: %;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Names</th>
                                                        <th>Designation</th>
                                                        <th>Department</th>
                                                        <th>Sign</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <td><input disabled type="text" name="Team_Members[0][serial]"
                                                            value="1">
                                                    </td>
                                                    <td><input type="text" name="Team_Members[0][names_tm]"></td>
                                                    <td><input type="text" name="Team_Members[0][designation]"></td>
                                                    <td><input type="text" name="Team_Members[0][department_tm]"></td>
                                                    <td><input type="text" name="Team_Members[0][sign_tm]"></td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input id="date_0_date_tm" type="text" name="Team_Members[0][date_tm]"  placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="Team_Members[0][date_tm]"  min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"    value="" id="date_0_date_tm"   class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        oninput="handleDateInput(this, 'date_0_date_tm')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    {{-- <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input id="date_0_date_rrv" type="text"  name="Report_Approval[0][date_rrv]"  placeholder="DD-MMM-YYYY" />
                                                                    <input type="date"
                                                                        name="Report_Approval[0][date_rrv]"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        id="date_0_date_rrv"
                                                                        class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        oninput="handleDateInput(this, 'date_0_date_rrv')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td> --}}

                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('#team_members_details').click(function(e) {
                                            function generateTableRow(serialNumber) {

                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="Team_Members[' + serialNumber +
                                                    '][serial]" value="' + (serialNumber) + '"></td>' +
                                                    '<td><input type="text" name="Team_Members[' + serialNumber + '][names_tm]"></td>' +
                                                    '<td><input type="text" name="Team_Members[' + serialNumber +
                                                    '][designation]"></td>'+
                                                    '<td><input type="text" name="Team_Members[' + serialNumber +
                                                    '][department_tm]"></td>' +
                                                    '<td><input type="text" name="Team_Members[' + serialNumber + '][sign_tm]"></td>' +
                                                    '<td><div class="new-date-data-field"><div class="group-input input-date"> <div class="calenderauditee"><input id="date_' +
                                                    serialNumber + '_date_tm" type="text" name="Team_Members[' + serialNumber +
                                                    '][date_tm]" placeholder="DD-MMM-YYYY" /> <input type="date" name="Team_Members[' +
                                                    serialNumber +
                                                    '][date_tm]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="date_' +
                                                    serialNumber +
                                                    '_date_tm" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_' +
                                                    serialNumber + '_date_tm\')" /> </div> </div></div></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +

                                                    '</tr>';

                                                return html;
                                            }

                                            var tableBody = $('#team_members_details_add tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount + 1);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Report Approval by Head QA/CQA (Final Approvalshall be done after QA Verification)
                                            <button type="button" id="add_report_approval_row">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="report_approval_table">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Names</th>
                                                        <th>Designation</th>
                                                        <th>Department</th>
                                                        <th>Sign</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text"
                                                                name="Report_Approval[0][serial]" value="1"></td>
                                                        <td><input type="text" name="Report_Approval[0][names_rrv]">
                                                        </td>
                                                         <td><input type="text"
                                                            name="Report_Approval[0][designation]"></td>
                                                        <td><input type="text"
                                                                name="Report_Approval[0][department_rrv]"></td>
                                                        <td><input type="text" name="Report_Approval[0][sign_rrv]">
                                                        </td>
                                                        <td>
                                                            <div class="new-date-data-field">
                                                                <div class="group-input input-date">
                                                                    <div class="calenderauditee">
                                                                        <input id="date_0_date_rrv" type="text"
                                                                            name="Report_Approval[0][date_rrv]"
                                                                            placeholder="DD-MMM-YYYY" />
                                                                        <input type="date"
                                                                            name="Report_Approval[0][date_rrv]"
                                                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                            id="date_0_date_rrv"
                                                                            class="hide-input show_date"
                                                                            style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                            oninput="handleDateInput(this, 'date_0_date_rrv')" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><button type="button" class="removeRowBtn">Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });

                                    $(document).ready(function() {
                                        $('#add_report_approval_row').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(reportNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="Report_Approval[' + reportNumber +
                                                    '][serial]" value="' + (reportNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="Report_Approval[' + reportNumber +
                                                    '][names_rrv]"></td>' +
                                                    '<td><input type="text" name="Report_Approval[' + reportNumber +
                                                    '][designation]"></td>' +
                                                    '<td><input type="text" name="Report_Approval[' + reportNumber +
                                                        '][department_rrv]"></td>' +
                                                    '<td><input type="text" name="Report_Approval[' + reportNumber +
                                                    '][sign_rrv]"></td>' +
                                                    '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee"><input id="date_' +
                                                    reportNumber + '_date_rrv" type="text" name="Report_Approval[' + reportNumber +
                                                    '][date_rrv]" placeholder="DD-MMM-YYYY" /> <input type="date" name="Report_Approval[' +
                                                    reportNumber +
                                                    '][date_rrv]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" id="date_' +
                                                    reportNumber +
                                                    '_date_rrv" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_' +
                                                    reportNumber + '_date_rrv\')" /> </div> </div></div></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#report_approval_table tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                                <div class="button-block">
                                    <button type="submit" class="saveButton">Save</button>
                                    <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                                    <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                    <button type="button"> <a class="text-white"
                                            href="{{ url('rcms/qms-dashboard') }}">
                                            Exit </a> </button>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div id="CCForm9" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="sub-head">
                                QA/CQA Head Review
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Closure Comment">QA/CQA Head Comment <span class="text-danger">*</span></label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                                require completion</small></div>
                                        <textarea class="summernote" name="qa_head_comment" id="qa_head_comment">
                                </textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                        <div class="group-input">
                                            <label for="Inv Attachments">QA/CQA Head Attachment</label>
                                            <div>
                                                <small class="text-primary">
                                                    Please Attach all relevant or supporting documents
                                                </small>
                                            </div>
                                            <div class="file-attachment-field">
                                                <div class="file-attachment-list" id="qa_cqa_he_attach">


                                                </div>
                                                <div class="add-btn">
                                                    <div>Add</div>
                                                    <input type="file" id="qa_cqa_he_attach"
                                                        name="qa_cqa_he_attach[]"
                                                        oninput="addMultipleFiles(this,'qa_cqa_he_attach')" multiple>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton" id="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                    </a> </button>
                            </div>
                        </div>
                    </div>


                    <div id="CCForm2" class="inner-block cctabcontent">
                        <div class="inner-block-content">
                            <div class="row">
                                <div class="sub-head col-12">Investigation</div>
                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Investigation Team
                                            <button type="button" id="investigation_team_add">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="Investing_team" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Name</th>
                                                        <th>Department</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text"
                                                                name="Investing_team[0][serial]" value="1"></td>
                                                        <td><input type="text" name="Investing_team[0][name_inv_tem]">
                                                        </td>
                                                        <td><input type="text"
                                                                name="Investing_team[0][department_inv_tem]"></td>
                                                        <td><input type="text"
                                                                name="Investing_team[0][remarks_inv_tem]"></td>
                                                        <td><button type="text" class="removeRowBtn">Remove</button>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    })
                                </script>
                                <script>
                                    $(document).ready(function() {
                                        $('#investigation_team_add').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="Investing_team[' + serialNumber +
                                                    '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="Investing_team[' + serialNumber +
                                                    '][name_inv_tem]"></td>' +
                                                    '<td><input type="text" name="Investing_team[' + serialNumber +
                                                    '][department_inv_tem]"></td>' +
                                                    '<td><input type="text" name="Investing_team[' + serialNumber +
                                                    '][remarks_inv_tem]"></td>' +
                                                    '<td><button type="text" class="removeRowBtn" >Remove</button></td>' +

                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#Investing_team tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Batch manufacturing record (BMR)">Review
                                            of Batch Manufacturing
                                            Record (BMR)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_batch_manufacturing_record_BMR_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label
                                            for="Review of Raw materials used in batch
                                        manufacturing">Review
                                            Of Raw Materials Used In Batch
                                            manufacturing</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_raw_materials_used_in_batch_manufacturing_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Batch Packing record (BPR)">Review of Batch Packing record
                                            (BPR)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_Batch_Packing_record_bpr_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of packing materials used in batch packing">Review Of Packing
                                            Materials Used In Batch
                                            Packing</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_packing_materials_used_in_batch_packing_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Analytical Data">Review of Analytical Data</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_analytical_data_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of training record of Concern Persons">Review of training record
                                            of Concern Persons</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_training_record_of_concern_persons_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Equipment/Instrument qualification/Calibration record">Review
                                            of Equipment/Instrument qualification/Calibration record</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="rev_eq_inst_qual_calib_record_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Equipment Break-down and Maintainance Record">Review Of
                                            Equipment Break-down And Maintainance Record</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_equipment_break_down_and_maintainance_record_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Review of Past history of product">Review of Past History Of
                                            Product</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="review_of_past_history_of_product_gi" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>
                             

                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="root_cause">
                                            Brain Storming Session/Discussion With Concerned Person
                                            <button type="button" id="brain_storming_add">+</button>
                                            <span class="text-primary" data-bs-toggle="modal"
                                                data-bs-target="#document-details-field-instruction-modal"
                                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                                (Launch Instruction)
                                            </span>
                                        </label>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="brain_stroming_details"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 100px;">Row #</th>
                                                        <th>Possibility</th>
                                                        <th>Facts/Controls</th>
                                                        <th>Probable Cause</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><input disabled type="text"
                                                                name="brain_stroming_details[0][serial]" value="1">
                                                        </td>
                                                        <td><input type="text"
                                                                name="brain_stroming_details[0][possibility_bssd]"></td>
                                                        <td><input type="text"
                                                                name="brain_stroming_details[0][factscontrols_bssd]"></td>
                                                        <td><input type="text"
                                                                name="brain_stroming_details[0][probable_cause_bssd]"></td>
                                                        <td><input type="text"
                                                                name="brain_stroming_details[0][remarks_bssd]"></td>
                                                        <td><button type="button" class="removeRowBtn">Remove</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document).on('click', '.removeRowBtn', function() {
                                        $(this).closest('tr').remove();
                                    });

                                    $(document).ready(function() {
                                        $('#brain_storming_add').click(function(e) {
                                            e.preventDefault();

                                            function generateTableRow(serialNumber) {
                                                var html =
                                                    '<tr>' +
                                                    '<td><input disabled type="text" name="brain_stroming_details[' + serialNumber +
                                                    '][serial]" value="' + (serialNumber + 1) + '"></td>' +
                                                    '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                    '][possibility_bssd]"></td>' +
                                                    '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                    '][factscontrols_bssd]"></td>' +
                                                    '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                    '][probable_cause_bssd]"></td>' +
                                                    '<td><input type="text" name="brain_stroming_details[' + serialNumber +
                                                    '][remarks_bssd]"></td>' +
                                                    '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                    '</tr>';
                                                return html;
                                            }

                                            var tableBody = $('#brain_stroming_details tbody');
                                            var rowCount = tableBody.children('tr').length;
                                            var newRow = generateTableRow(rowCount);
                                            tableBody.append(newRow);
                                        });
                                    });
                                </script>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Conclusion (A dedicated provision must be established to record the inference or outcome of brainstorming sessions) ">Conclusion (A dedicated provision must be established to record the inference or outcome of brainstorming sessions) </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="conclusion_pi" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="The probable root causes or Root Cause">The probable root causes or Root Cause </label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="the_probable_root" id="summernote-1">
                                </textarea>
                                </div>
                            </div>

                                <div class="sub-head col-12">HOD Review</div>



                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Conclusion">Conclusion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="conclusion_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Root Cause Analysis">Root Cause Analysis</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="root_cause_analysis_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label
                                            for="The most probable root causes identified of the complaint are as below">The
                                            Most Probable Root Causes Identified Of The Complaint Are As Below</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="probable_root_causes_complaint_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Impact Assessment">Impact Assessment</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="impact_assessment_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Corrective Action">Corrective Action</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="corrective_action_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>


                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Preventive Action">Preventive Action</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="preventive_action_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Summary and Conclusion">Summary And Conclusion</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="summary_and_conclusion_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>


                               



                                



                                <div class="col-12">
                                    <div class="group-input">
                                        <label for="Inv Attachments">HOD Attachment</label>
                                        <div>
                                            <small class="text-primary">
                                                Please Attach all relevant or supporting documents
                                            </small>
                                        </div>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="initial_attachment_hodsr"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="initial_attachment_hodsr"
                                                    name="initial_attachment_hodsr[]"
                                                    oninput="addMultipleFiles(this,'initial_attachment_hodsr')" multiple>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="group-input">
                                        <label for="Comments">Comments(if Any)</label>
                                        <div><small class="text-primary">Please insert "NA" in the data field if it does
                                                not require completion</small></div>
                                        <textarea class="summernote" name="comments_if_any_hodsr" id="summernote-1">
                                    </textarea>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="group-input">
                                        <label for="Support_doc">Supporting Documents</label>
                                        <div class="file-attachment-field">
                                            <div class="file-attachment-list" id="Support_doc"></div>
                                            <div class="add-btn">
                                                <div>Add</div>
                                                <input type="file" id="myfile" name="Support_doc[]"
                                                    oninput="addMultipleFiles(this, 'Support_doc')" multiple>
                                            </div>
                                        </div>

                                    </div>
                                </div> --}}
                            </div>
                            <div class="button-block">
                                <button type="submit" class="saveButton">Save</button>
                                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                                <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                                <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                        Exit </a> </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="CCForm3" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">Acknowledgement</div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Manufacturer name & Address">Manufacturer Name & Address</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" name="manufacturer_name_address_ca" id="summernote-1">
                                    </textarea>
                                </div>
                            </div>



                            <div class="col-12">
                                <div class="group-input">
                                    <label for="root_cause">
                                        Product/Material Details
                                        <button type="button" id="promate_add">+</button>
                                        <span class="text-primary" data-bs-toggle="modal"
                                            data-bs-target="#document-details-field-instruction-modal"
                                            style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                            (Launch Instruction)
                                        </span>
                                    </label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="prod_mate_details" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 100px;">Row #</th>
                                                    <th>Product Name</th>
                                                    <th>Batch No.</th>
                                                    <th>Mfg. Date</th>
                                                    <th>Exp. Date</th>
                                                    <th>Batch Size</th>
                                                    <th>Pack Profile</th>
                                                    <th>Released Quantity</th>
                                                    <th>Remarks</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input disabled type="text" name="Product_MaterialDetails[0][serial]" value="1"></td>
                                                    <td><input type="text" name="Product_MaterialDetails[0][product_name_ca]"></td>
                                                    <td><input type="text" name="Product_MaterialDetails[0][batch_no_pmd_ca]"></td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input id="date_0_mfg_date_pmd_ca" type="text"
                                                                        name="Product_MaterialDetails[0][mfg_date_pmd_ca]"
                                                                        readonly
                                                                        placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="Product_MaterialDetails[0][mfg_date_pmd_ca]"
                                                                         min="{{ today()->subDays(1000)->format('Y-m-d') }}"
                                                                        {{-- min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" --}}
                                                                        id="date_0_mfg_date_pmd_ca" class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        oninput="handleDateInput(this, 'date_0_mfg_date_pmd_ca')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="new-date-data-field">
                                                            <div class="group-input input-date">
                                                                <div class="calenderauditee">
                                                                    <input class="click_date" id="date_0_expiry_date_pmd_ca" type="text"
                                                                        name="Product_MaterialDetails[0][expiry_date_pmd_ca]"
                                                                        placeholder="DD-MMM-YYYY" />
                                                                    <input type="date" name="Product_MaterialDetails[0][expiry_date_pmd_ca]"
                                                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                                        id="date_0_expiry_date_pmd_ca" class="hide-input show_date"
                                                                        style="position: absolute; top: 0; left: 0; opacity: 0;"
                                                                        oninput="handleDateInput(this, 'date_0_expiry_date_pmd_ca')" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="Product_MaterialDetails[0][batch_size_pmd_ca]"></td>
                                                    <td><input type="text" name="Product_MaterialDetails[0][pack_profile_pmd_ca]"></td>
                                                    <td><input type="text" name="Product_MaterialDetails[0][released_quantity_pmd_ca]"></td>
                                                    <td><input type="text" name="Product_MaterialDetails[0][remarks_ca]"></td>
                                                    <td><button type="button" class="removeRowBtn">Remove</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).on('click', '.removeRowBtn', function() {
                                    $(this).closest('tr').remove();
                                });

                                $(document).ready(function() {
                                    // Set a JavaScript variable with the current date from Blade
                                    var currentDate = '{{ \Carbon\Carbon::now()->format('Y-m-d') }}';

                                    $('#promate_add').click(function(e) {
                                        e.preventDefault();

                                        function generateTableRow(productserialno) {
                                            var html = '<tr>' +
                                                '<td><input disabled type="text" name="Product_MaterialDetails[' + productserialno + '][serial]" value="' + (productserialno + 1) + '"></td>' +
                                                '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][product_name_ca]"></td>' +
                                                '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][batch_no_pmd_ca]"></td>' +
                                                '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee">' +
                                                '<input id="date_' + productserialno + '_mfg_date_pmd_ca" type="text" name="Product_MaterialDetails[' + productserialno + '][mfg_date_pmd_ca]" placeholder="DD-MMM-YYYY" />' +
                                                '<input type="date" name="Product_MaterialDetails[' + productserialno + '][mfg_date_pmd_ca]" readonly min="{{today()->subDays(1000)->format('Y-m-d')}}"  id="date_' + productserialno + '_mfg_date_pmd_ca" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_' + productserialno + '_mfg_date_pmd_ca\')"/>' +
                                                '</div></div></div></td>' +

                                                '<td><div class="new-date-data-field"><div class="group-input input-date"><div class="calenderauditee">' +
                                                '<input id="date_' + productserialno + '_expiry_date_pmd_ca" type="text" readonly name="Product_MaterialDetails[' + productserialno + '][expiry_date_pmd_ca]" placeholder="DD-MMM-YYYY" />' +
                                                '<input type="date" name="Product_MaterialDetails[' + productserialno + '][expiry_date_pmd_ca]" min="' + currentDate + '" id="date_' + productserialno + '_expiry_date_pmd_ca" class="hide-input show_date" style="position: absolute; top: 0; left: 0; opacity: 0;" oninput="handleDateInput(this, \'date_' + productserialno + '_expiry_date_pmd_ca\')"/>' +
                                                '</div></div></div></td>' +

                                                '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][batch_size_pmd_ca]"></td>' +
                                                '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][pack_profile_pmd_ca]"></td>' +
                                                '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][released_quantity_pmd_ca]"></td>' +
                                                '<td><input type="text" name="Product_MaterialDetails[' + productserialno + '][remarks_ca]"></td>' +
                                                '<td><button type="button" class="removeRowBtn">Remove</button></td>' +
                                                '</tr>';
                                            return html;
                                        }

                                        var tableBody = $('#prod_mate_details tbody');
                                        var rowCount = tableBody.children('tr').length;
                                        var newRow = generateTableRow(rowCount);
                                        tableBody.append(newRow);
                                    });
                                });
                            </script>







                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Complaint Sample Required">Complaint Sample Required</label>
                                    <select name="complaint_sample_required_ca" onchange="">
                                        <option value="">-- select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="group-input">
                                    <label for="Complaint Sample Status">Complaint Sample Status</label>
                                    <input type="text" name="complaint_sample_status_ca" id="date_of_initiation">
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Brief Description of complaint">Brief Description of complaint</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="brief_description_of_complaint_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Batch Record review observation">Batch Record Review
                                        Observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="batch_record_review_observation_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Analytical Data review observation">Analytical Data Review
                                        Observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="analytical_data_review_observation_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Retention sample review observation">Retention Sample Review
                                        Observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="retention_sample_review_observation_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Stablity study data review">Stablity Study Data Review</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="stability_study_data_review_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="QMS Events(if any) review Observation">QMS Events(If Any) Review
                                        Observation</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="qms_events_ifany_review_observation_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Repeated complaints/queries for product">Repeated Complaints/Queries
                                        For Product:</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="repeated_complaints_queries_for_product_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Interpretation on compalint sample">Interpretation On Complaint
                                        Sample(if recieved)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="interpretation_on_complaint_sample_ifrecieved_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Comments">Comments(if Any)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="summernote" name="comments_ifany_ca" id="summernote-1">
                                </textarea>
                                </div>
                            </div>

                            <div class="sub-head">
                                Proposal To Accomplish Investigation:
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr. No.</th>
                                                    <th style="width: 40%;">Requirements</th>
                                                    <th style="width: 10%;">Yes/No</th>
                                                    <th style="width: 20%;">Expected date of investigation completion</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <style>
                                                .main-head {
                                                    display: flex;
                                                    justify-content: space-around;
                                                    gap: 12px;
                                                }

                                                .label-head {
                                                    display: flex !important;
                                                    gap: 14px;
                                                }

                                                .input-head {
                                                    margin-top: 4px;
                                                }
                                            </style>
                                            <tbody>
                                                <tr>
                                                    <td class="flex text-center">1</td>
                                                    <td>Complaint Sample Required</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <span class="input-head"><input type="radio"
                                                                    name="csr1_yesno" value="yes"
                                                                    onchange="toggleInputs('csr1_yesno', 'csr1', 'csr2')"></span>
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head">
                                                            <span class="input-head"><input type="radio"
                                                                    name="csr1_yesno" value="no"
                                                                    onchange="toggleInputs('csr1_yesno', 'csr1', 'csr2')"></span>
                                                            <span>No</span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="csr1" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="csr2" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">2</td>
                                                    <td>Additional info. From Complaint</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="afc1_yesno" value="yes"
                                                                onchange="toggleInputs('afc1_yesno', 'afc1', 'afc2')"> Yes
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="afc1_yesno" value="no"
                                                                onchange="toggleInputs('afc1_yesno', 'afc1', 'afc2')"> No
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="afc1" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="afc2" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">3</td>
                                                    <td>Analysis Of Complaint Sample</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="acs1_yesno" value="yes"
                                                                onchange="toggleInputs('acs1_yesno', 'acs1', 'acs2')"> Yes
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="acs1_yesno" value="no"
                                                                onchange="toggleInputs('acs1_yesno', 'acs1', 'acs2')"> No
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="acs1" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="acs2" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">4</td>
                                                    <td>QRM Approach</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="qrm1_yesno" value="yes"
                                                                onchange="toggleInputs('qrm1_yesno', 'qrm1', 'qrm2')"> Yes
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="qrm1_yesno" value="no"
                                                                onchange="toggleInputs('qrm1_yesno', 'qrm1', 'qrm2')"> No
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="qrm1" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="qrm2" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">5</td>
                                                    <td>Others</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="oth1_yesno" value="yes"
                                                                onchange="toggleInputs('oth1_yesno', 'oth1', 'oth2')"> Yes
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="oth1_yesno" value="no"
                                                                onchange="toggleInputs('oth1_yesno', 'oth1', 'oth2')"> No
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="oth1" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="oth2" style="border-radius: 7px; border: 1.5px solid black;" disabled></textarea>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function toggleInputs(radioName, textarea1, textarea2) {
                                    const radios = document.getElementsByName(radioName);
                                    let enableInputs = false;

                                    for (const radio of radios) {
                                        if (radio.checked && radio.value === 'yes') {
                                            enableInputs = true;
                                            break;
                                        }
                                    }

                                    document.getElementsByName(textarea1)[0].disabled = !enableInputs;
                                    document.getElementsByName(textarea2)[0].disabled = !enableInputs;
                                }

                                // Call toggleInputs for each set of radio buttons to initialize the state on page load
                                document.addEventListener('DOMContentLoaded', () => {
                                    toggleInputs('csr1_yesno', 'csr1', 'csr2');
                                    toggleInputs('afc1_yesno', 'afc1', 'afc2');
                                    toggleInputs('acs1_yesno', 'acs1', 'acs2');
                                    toggleInputs('qrm1_yesno', 'qrm1', 'qrm2');
                                    toggleInputs('oth1_yesno', 'oth1', 'oth2');
                                });
                            </script>


                            {{-- <div class="sub-head">
                                Proposal to accomplish investigation:
                            </div>
                            <div class="col-12">
                                <div class="group-input">
                                    <div class="why-why-chart">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">Sr. No.</th>
                                                    <th style="width: 40%;">Requirements</th>
                                                    <th style="width: 10%;">Yes/No</th>
                                                    <th style="width: 20%;">Expected date of investigation completion</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <style>
                                                .main-head{
                                                   display: flex;
                                                   justify-content: space-around;
                                                   gap: 12px;
                                                }
                                                .label-head{
                                                   display: flex !important;
                                                    gap: 14px;
                                                }
                                                .input-head{
                                                   margin-top: 4px;
                                                }
                                               </style>
                                            <tbody>
                                                <tr>
                                                    <td class="flex text-center" name="">1</td>
                                                    <td>Complaint sample Required</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <span class="input-head"><input type="radio" name="csr1_yesno" value="yes"></span>
                                                            <span>Yes</span>
                                                        </label>
                                                        <label class="label-head" >
                                                           <span class="input-head"> <input type="radio" name="csr1_yesno" value="no"></span>
                                                          <span>  No</span>
                                                        </label>
                                                    </td>
                                                    <td>

                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="csr1" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                        </div>


                                                    </td>
                                                    </td>

                                                    <td style="vertical-align: middle;">
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="csr2" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                        </div>
                                                    </td>



                                                </tr>
                                                <tr>
                                                    <td class="flex text-center">2</td>
                                                    <td>Additional info. From Complainant</td>
                                                    <td class="main-head">
                                                        <label class="label-head">
                                                            <input type="radio" name="afc1_yesno" value="yes"> Yes
                                                        </label>
                                                        <label class="label-head">
                                                            <input type="radio" name="afc1_yesno" value="no"> No
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <div style="margin: auto; display: flex; justify-content: center;">
                                                            <textarea name="afc1" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                        </div>
                                    </div>
                                    </td>

                                    <td style="vertical-align: middle;">
                                        <div style="margin: auto; display: flex; justify-content: center;">
                                            <textarea name="afc2" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                        <td class="flex text-center">3</td>
                                        <td>Analysis of complaint Sample</td>
                                        <td class="main-head">
                                            <label class="label-head">
                                                <input type="radio" name="acs1_yesno" value="yes"> Yes
                                            </label>
                                            <label class="label-head">
                                                <input type="radio" name="acs1_yesno" value="no"> No
                                            </label>
                                        </td>
                                        <td>
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="acs1" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                            </div>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="acs2" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                            </div>
                                        </td>




                                    </tr>
                                    <tr>
                                        <td class="flex text-center">4</td>
                                        <td>QRM Approach</td>
                                        <td class="main-head">
                                            <label class="label-head">
                                                <input type="radio" name="qrm1_yesno" value="yes"> Yes
                                            </label>
                                            <label class="label-head">
                                                <input type="radio" name="qrm1_yesno" value="no"> No
                                            </label>
                                        </td>
                                        <td>
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="qrm1" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                            </div>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="qrm2" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                            </div>
                                        </td>



                                    </tr>
                                    <tr>
                                        <td class="flex text-center">5</td>
                                        <td>Others</td>
                                        <td class="main-head">
                                            <label class="label-head">
                                                <input type="radio" name="oth1_yesno" value="yes"> Yes
                                            </label>
                                            <label class="label-head">
                                                <input type="radio" name="oth1_yesno" value="no"> No
                                            </label>
                                        </td>
                                        <td>
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="oth1" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                            </div>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <div style="margin: auto; display: flex; justify-content: center;">
                                                <textarea name="oth2" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                            </div>
                                        </td>



                                    </tr>

                                    </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}


                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Acknowledgement Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_ca"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="initial_attachment_ca"
                                                name="initial_attachment_ca[]"
                                                oninput="addMultipleFiles(this,'initial_attachment_ca')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">
                                    Exit </a> </button>
                        </div>
                    </div>




                </div>

                <!-- CFT -->
                <div id="CCForm6" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="row">
                            <div class="sub-head">
                                Production (Tablet/Capsule/Powder)
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.productionTable').hide();

                                    $('[name="Production_Table_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.productionTable').show();
                                            $('.productionTable span').show();
                                        } else {
                                            $('.productionTable').hide();
                                            $('.productionTable span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Production Tablet"> Production Tablet</label>
                                    <select name="Production_Table_Review" id="Production_Table_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 productionTable">
                                <div class="group-input">
                                    <label for="Production Tablet notification">Production Tablet Person</label>
                                    <select name="Production_Table_Person" class="Production_Table_Person"
                                        id="Production_Table_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 productionTable">
                                <div class="group-input">
                                    <label for="Production Tablet assessment">Impact Assessment (By Production
                                        Tablet)</label>
                                    <textarea class="summernote Production_Table_Assessment" name="Production_Table_Assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 productionTable">
                                <div class="group-input">
                                    <label for="Production Tablet feedback">Production Tablet Feedback</label>
                                    <textarea class="summernote Production_Table_Feedback" name="Production_Table_Feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 productionTable">
                                <div class="group-input">
                                    <label for="Production Tablet attachment">Production Tablet Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Production_Table_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Production_Table_Attachment[]"
                                                oninput="addMultipleFiles(this, 'Production_Table_Attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 productionTable">
                                <div class="group-input">
                                    <label for="Production Tablet Completed By">Production Tablet Completed By</label>
                                    <input readonly type="text" name="Production_Table_By" id="Production_Table_By">
                                </div>
                            </div>
                            <div class="col-lg-6 productionTable">
                                <div class="group-input ">
                                    <label for="Production Tablet Completed On">Production Tablet Completed On</label>
                                    <input type="date" id="Production_Table_On" name="Production_Table_On">
                                </div>
                            </div>

                            <div class="sub-head">
                                Production Injection
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.productionInjection').hide();

                                    $('[name="Production_Injection_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.productionInjection').show();
                                            $('.productionInjection span').show();
                                        } else {
                                            $('.productionInjection').hide();
                                            $('.productionInjection span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Production Injection"> Production Injection </label>
                                    <select name="Production_Injection_Review" id="Production_Injection_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 productionInjection">
                                <div class="group-input">
                                    <label for="Production Injection notification">Production Injection Person</label>
                                    <select class="Production_Injection_Person" id="Production_Injection_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 productionInjection">
                                <div class="group-input">
                                    <label for="Production Injection assessment">Impact Assessment (By Production
                                        Injection)</label>
                                    <textarea class="summernote Production_Injection_Assessment" name="Production_Injection_Assessment"
                                        id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 productionInjection">
                                <div class="group-input">
                                    <label for="Production Injection feedback">Production Injection Feedback </label>
                                    <textarea class="summernote Production_Injection_Feedback" name="Production_Injection_Feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 productionInjection">
                                <div class="group-input">
                                    <label for="Production Injection attachment">Production Injection
                                        Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Production_Injection_Attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Production_Injection_Attachment[]"
                                                oninput="addMultipleFiles(this, 'Production_Injection_Attachment')"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 productionInjection">
                                <div class="group-input">
                                    <label for="Production Injection Completed By">Production Injection Completed
                                        By</label>
                                    <input readonly type="text" name="Production_Injection_By"
                                        id="Production_Injection_By">
                                </div>
                            </div>
                            <div class="col-lg-6 productionInjection">
                                <div class="group-input ">
                                    <label for="Production Injection Completed On">Production Injection Completed
                                        On</label>
                                    <input type="date"id="Production_Injection_On" name="Production_Injection_On">
                                </div>
                            </div>


                            <div class="sub-head">
                                Research & Development
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.researchDevelopment').hide();

                                    $('[name="ResearchDevelopment_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.researchDevelopment').show();
                                            $('.researchDevelopment span').show();
                                        } else {
                                            $('.researchDevelopment').hide();
                                            $('.researchDevelopment span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Research Development"> Research Development Required ?</label>
                                    <select name="ResearchDevelopment_Review" id="ResearchDevelopment_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 researchDevelopment">
                                <div class="group-input">
                                    <label for="Research Development notification">Research Development Person</label>
                                    <select name="ResearchDevelopmentStore_Person" class="ResearchDevelopment_Person"
                                        id="ResearchDevelopment_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 researchDevelopment">
                                <div class="group-input">
                                    <label for="Research Development assessment">Impact Assessment (By Research
                                        Development)</label>
                                    <textarea class="summernote ResearchDevelopment_assessment" name="ResearchDevelopment_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 researchDevelopment">
                                <div class="group-input">
                                    <label for="Research Development feedback">Research Development Feedback</label>
                                    <textarea class="summernote ResearchDevelopment_feedback" name="ResearchDevelopment_feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 researchDevelopment">
                                <div class="group-input">
                                    <label for="Research Development attachment">Research Development
                                        Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="ResearchDevelopment_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="ResearchDevelopment_attachment[]"
                                                oninput="addMultipleFiles(this, 'ResearchDevelopment_attachment')"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 researchDevelopment">
                                <div class="group-input">
                                    <label for="Research Development Completed By">Research Development Completed
                                        By</label>
                                    <input readonly type="text" name="ResearchDevelopment_by"
                                        id="ResearchDevelopment_by">
                                </div>
                            </div>
                            <div class="col-lg-6 researchDevelopment">
                                <div class="group-input ">
                                    <label for="Research Development Completed On">Research Development Complete
                                        On</label>
                                    <input type="date" id="ResearchDevelopment_on" name="ResearchDevelopment_on">
                                </div>
                            </div>

                            <div class="sub-head">
                                Human Resource
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.human_resources').hide();

                                    $('[name="Human_Resource_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.human_resources').show();
                                            $('.human_resources span').show();
                                        } else {
                                            $('.human_resources').hide();
                                            $('.human_resources span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Administration Review Required">Human Resource
                                        Required ?</label>
                                    <select name="Human_Resource_review" id="Human_Resource_review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 31, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 human_resources">
                                <div class="group-input">
                                    <label for="Administration Person"> Human Resource Person</label>
                                    <select name="Human_Resource_person" id="Human_Resource_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 human_resources">
                                <div class="group-input">
                                    <label for="Impact Assessment9">Impact Assessment (By Human Resource )</label>
                                    <textarea class="" name="Human_Resource_assessment" id="summernote-35"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 human_resources">
                                <div class="group-input">
                                    <label for="productionfeedback">Human Resource Feedback</label>
                                    <textarea class="" name="Human_Resource_feedback" id="summernote-36"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 human_resources">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Human Resource
                                        Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Human_Resource_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Human_Resource_attachment[]"
                                                oninput="addMultipleFiles(this, 'Human_Resource_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 human_resources">
                                <div class="group-input">
                                    <label for="Administration Review Completed By"> Human Resource Review Completed
                                        By</label>
                                    <input type="text" name="Human_Resource_by" id="Human_Resource_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field human_resources">
                                <div class="group-input input-date">
                                    <label for="Administration Review Completed On">Human Resource Review Completed
                                        On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Human_Resource_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="Human_Resource_on"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'Human_Resource_on')" />
                                    </div>
                                </div>
                            </div>


                            <div class="sub-head">
                                Corporate Quality Assurance
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.CQA').hide();

                                    $('[name="CorporateQualityAssurance_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.CQA').show();
                                            $('.CQA span').show();
                                        } else {
                                            $('.CQA').hide();
                                            $('.CQA span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Corporate Quality Assurance"> Corporate Quality Assurance Required
                                        ?</label>
                                    <select name="CorporateQualityAssurance_Review"
                                        id="CorporateQualityAssurance_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 CQA">
                                <div class="group-input">
                                    <label for="Corporate Quality Assurance notification">Corporate Quality Assurance
                                        Person</label>
                                    <select name="CorporateQualityAssurance_Person"
                                        class="CorporateQualityAssurance_Person" id="CorporateQualityAssurance_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 CQA">
                                <div class="group-input">
                                    <label for="Corporate Quality Assurance assessment">Impact Assessment (By Corporate
                                        Quality Assurance)</label>
                                    <textarea class="summernote CorporateQualityAssurance_assessment" readonly
                                        name="CorporateQualityAssurance_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 CQA">
                                <div class="group-input">
                                    <label for="Corporate Quality Assurance feedback">Corporate Quality Assurance
                                        Feedback</label>
                                    <textarea class="summernote CorporateQualityAssurance_feedback" name="CorporateQualityAssurance_feedback"
                                        id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 CQA">
                                <div class="group-input">
                                    <label for="Corporate Quality Assurance attachment">Corporate Quality Assurance
                                        Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="CorporateQualityAssurance_attachment">
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile"
                                                name="CorporateQualityAssurance_attachment[]"
                                                oninput="addMultipleFiles(this, 'CorporateQualityAssurance_attachment')"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 CQA">
                                <div class="group-input">
                                    <label for="Corporate Quality Assurance Completed By">Corporate Quality Assurance
                                        Completed By</label>
                                    <input readonly type="text" name="CorporateQualityAssurance_by"
                                        id="CorporateQualityAssurance_by">
                                </div>
                            </div>
                            <div class="col-lg-6 CQA">
                                <div class="group-input ">
                                    <label for="Corporate Quality Assurance Completed On">Corporate Quality Assurance
                                        Completed On</label>
                                    <input type="date"id="CorporateQualityAssurance_on"
                                        name="CorporateQualityAssurance_on">
                                </div>
                            </div>


                            <div class="sub-head">
                                Stores
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.store').hide();

                                    $('[name="Store_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.store').show();
                                            $('.store span').show();
                                        } else {
                                            $('.store').hide();
                                            $('.store span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Store"> Store</label>
                                    <select name="Store_Review" id="Store_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 23, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 store">
                                <div class="group-input">
                                    <label for="Store notification">Store Person</label>
                                    <select name="Store_Person" class="Store_Person" id="Store_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 store">
                                <div class="group-input">
                                    <label for="Store assessment">Impact Assessment (By Store)</label>
                                    <textarea class="summernote Store_assessment" name="Store_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 store">
                                <div class="group-input">
                                    <label for="Store feedback">Store Feedback</label>
                                    <textarea class="summernote Store_feedback" name="Store_feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 store">
                                <div class="group-input">
                                    <label for="Store attachment">Store Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Store_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Store_attachment[]"
                                                oninput="addMultipleFiles(this, 'Store_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 store">
                                <div class="group-input">
                                    <label for="Store Completed By">Store Completed By</label>
                                    <input readonly type="text" name="Store_by" id="Store_by">
                                </div>
                            </div>
                            <div class="col-lg-6 store">
                                <div class="group-input ">
                                    <label for="Store Completed On">Store Completed On</label>
                                    <input type="date"id="Store_on" name="Store_on">
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.engineering').hide();

                                    $('[name="Engineering_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.engineering').show();
                                            $('.engineering span').show();
                                        } else {
                                            $('.engineering').hide();
                                            $('.engineering span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="sub-head">
                                Engineering
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Engineering Review Required">Engineering Review Required ?</label>
                                    <select name="Engineering_review" id="Engineering_review" disabled>
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 26, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 engineering">
                                <div class="group-input">
                                    <label for="Engineering Person">Engineering Person</label>
                                    <select name="Engineering_person" id="Engineering_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 engineering">
                                <div class="group-input">
                                    <label for="Impact Assessment4">Impact Assessment (By Engineering)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="" name="Engineering_assessment" id="summernote-25">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 engineering">
                                <div class="group-input">
                                    <label for="productionfeedback">Engineering Feedback</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="" name="Engineering_feedback" id="summernote-26">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 engineering">
                                <div class="group-input">
                                    <label for="Audit Attachments">Engineering Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Engineering_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Engineering_attachment[]"
                                                oninput="addMultipleFiles(this, 'Engineering_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 engineering">
                                <div class="group-input">
                                    <label for="Engineering Review Completed By">Engineering Review Completed
                                        By</label>
                                    <input type="text" name="Engineering_by" id="Engineering_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field engineering">
                                <div class="group-input input-date">
                                    <label for="Engineering Review Completed On">Engineering Review Completed
                                        On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Engineering_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="Engineering_on"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'Engineering_on')" />
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.project_management').hide();

                                    $('[name="Project_management_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.project_management').show();
                                            $('.project_management span').show();
                                        } else {
                                            $('.project_management').hide();
                                            $('.project_management span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Regulatory Affair
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.RegulatoryAffair').hide();

                                    $('[name="RegulatoryAffair_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.RegulatoryAffair').show();
                                            $('.RegulatoryAffair span').show();
                                        } else {
                                            $('.RegulatoryAffair').hide();
                                            $('.RegulatoryAffair span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="RegulatoryAffair"> Regulatory Affair Required ?</label>
                                    <select name="RegulatoryAffair_Review" id="RegulatoryAffair_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 RegulatoryAffair">
                                <div class="group-input">
                                    <label for="Regulatory Affair notification">Regulatory Affair Person</label>
                                    <select name="RegulatoryAffair_Person" class="RegulatoryAffair_Person"
                                        id="RegulatoryAffair_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                <div class="group-input">
                                    <label for="Regulatory Affair assessment">Impact Assessment (By Regulatory
                                        Affair)</label>
                                    <textarea class="summernote RegulatoryAffair_assessment" name="RegulatoryAffair_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 RegulatoryAffair">
                                <div class="group-input">
                                    <label for="Regulatory Affair feedback">Regulatory Affair Feedback</label>
                                    <textarea class="summernote RegulatoryAffair_feedback" name="RegulatoryAffair_feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 RegulatoryAffair">
                                <div class="group-input">
                                    <label for="Regulatory Affair attachment">Regulatory Affair Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="RegulatoryAffair_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="RegulatoryAffair_attachment[]"
                                                oninput="addMultipleFiles(this, 'RegulatoryAffair_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 RegulatoryAffair">
                                <div class="group-input">
                                    <label for="Regulatory Affair Completed By">Regulatory Affair Completed By</label>
                                    <input readonly type="text" name="RegulatoryAffair_by"
                                        id="RegulatoryAffair_by">
                                </div>
                            </div>
                            <div class="col-lg-6 RegulatoryAffair">
                                <div class="group-input ">
                                    <label for="Regulatory Affair Completed On">Regulatory Affair Completed On</label>
                                    <input type="date"id="RegulatoryAffair_on" name="RegulatoryAffair_on">
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.quality_assurance').hide();

                                    $('[name="Quality_Assurance"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.quality_assurance').show();
                                            $('.quality_assurance span').show();
                                        } else {
                                            $('.quality_assurance').hide();
                                            $('.quality_assurance span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Quality Assurance
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Customer notification">Quality Assurance Review Required ?</label>
                                    <select name="Quality_Assurance" id="QualityAssurance_review" disabled>
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 25, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 quality_assurance">
                                <div class="group-input">
                                    <label for="Quality Assurance Person">Quality Assurance Person</label>
                                    <select name="QualityAssurance_person" id="QualityAssurance_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 quality_assurance">
                                <div class="group-input">
                                    <label for="Impact Assessment3">Impact Assessment (By Quality Assurance)</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="" name="QualityAssurance_assessment" id="summernote-23">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 quality_assurance">
                                <div class="group-input">
                                    <label for="Quality Assurance Feedback">Quality Assurance Feedback</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does
                                            not require completion</small></div>
                                    <textarea class="" name="QualityAssurance_feedback" id="summernote-24">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 quality_assurance">
                                <div class="group-input">
                                    <label for="Quality Assurance Attachments">Quality Assurance Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Quality_Assurance_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Quality_Assurance_attachment[]"
                                                oninput="addMultipleFiles(this, 'Quality_Assurance_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 quality_assurance">
                                <div class="group-input">
                                    <label for="Quality Assurance Review Completed By">Quality Assurance Review
                                        Completed By</label>
                                    <input type="text" name="QualityAssurance_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field quality_assurance">
                                <div class="group-input input-date">
                                    <label for="Quality Assurance Review Completed On">Quality Assurance Review
                                        Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="QualityAssurance_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="QualityAssurance_on"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'QualityAssurance_on')" />
                                    </div>
                                </div>
                            </div>



                            <div class="sub-head">
                                Production (Liquid/Ointment)
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.productionLiquid').hide();

                                    $('[name="ProductionLiquid_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.productionLiquid').show();
                                            $('.productionLiquid span').show();
                                        } else {
                                            $('.productionLiquid').hide();
                                            $('.productionLiquid span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Production Liquid"> Production Liquid </label>
                                    <select name="ProductionLiquid_Review" id="ProductionLiquid_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 productionLiquid">
                                <div class="group-input">
                                    <label for="Production Liquid notification">Production Liquid Person</label>
                                    <select name="ProductionLiquid_Person" class="ProductionLiquid_Person"
                                        id="ProductionLiquid_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 productionLiquid">
                                <div class="group-input">
                                    <label for="Production Liquid assessment">Impact Assessment (By Production
                                        Liquid)</label>
                                    <textarea class="summernote ProductionLiquid_assessment" name="ProductionLiquid_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 productionLiquid">
                                <div class="group-input">
                                    <label for="Production Liquid feedback">Production Liquid Feedback</label>
                                    <textarea class="summernote ProductionLiquid_feedback" name="ProductionLiquid_feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 productionLiquid">
                                <div class="group-input">
                                    <label for="Production Liquid attachment">Production Liquid Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div> ProductionLiquid_attachment
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="ProductionLiquid_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="ProductionLiquid_attachment[]"
                                                oninput="addMultipleFiles(this, 'ProductionLiquid_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 productionLiquid">
                                <div class="group-input">
                                    <label for="Production Liquid Completed By">Production Liquid Completed By</label>
                                    <input readonly type="text" name="ProductionLiquid_by"
                                        id="ProductionLiquid_by">
                                </div>
                            </div>
                            <div class="col-lg-6 productionLiquid">
                                <div class="group-input ">
                                    <label for="Production Liquid Completed On">Production Liquid Completed On</label>
                                    <input type="date" id="ProductionLiquid_on" name="ProductionLiquid_on">
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.quality_control').hide();

                                    $('[name="Quality_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.quality_control').show();
                                            $('.quality_control span').show();
                                        } else {
                                            $('.quality_control').hide();
                                            $('.quality_control span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Quality Control
                            </div>
                            <div class="col-lg-6 quality_control">
                                <div class="group-input">
                                    <label for="Quality Control Review Required">Quality Control Review Required
                                        ?</label>
                                    <select name="Quality_review" id="Quality_review" disabled>
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 24, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Quality Control Person">Quality Control Person</label>
                                    <select name="Quality_Control_Person" id="Quality_Control_Person" disabled>
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 quality_control">
                                <div class="group-input">
                                    <label for="Impact Assessment2">Impact Assessment (By Quality Control)</label>
                                    <textarea class="" name="Quality_Control_assessment" id="summernote-21">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 quality_control">
                                <div class="group-input">
                                    <label for="Quality Control Feedback">Quality Control Feedback</label>
                                    <textarea class="" name="Quality_Control_feedback" id="summernote-22">
                        </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 quality_control">
                                <div class="group-input">
                                    <label for="Quality Control Attachments">Quality Control Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Quality_Control_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Quality_Control_attachment[]"
                                                oninput="addMultipleFiles(this, 'Quality_Control_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 quality_control">
                                <div class="group-input">
                                    <label for="productionfeedback">Quality Control Review Completed By</label>
                                    <input type="text" name="QualityAssurance__by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field quality_control">
                                <div class="group-input input-date">
                                    <label for="Quality Control Review Completed On">Quality Control Review Completed
                                        On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Quality_Control_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="Quality_Control_on"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'Quality_Control_on')" />
                                    </div>
                                </div>
                            </div>
                            <div class="sub-head">
                                Microbiology
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.Microbiology').hide();

                                    $('[name="Microbiology_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.Microbiology').show();
                                            $('.Microbiology span').show();
                                        } else {
                                            $('.Microbiology').hide();
                                            $('.Microbiology span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Microbiology"> Microbiology Required ?</label>
                                    <select name="Microbiology_Review" id="Microbiology_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 Microbiology">
                                <div class="group-input">
                                    <label for="Microbiology notification">Microbiology Person</label>
                                    <select name="Microbiology_Person" class="Microbiology_Person"
                                        id="Microbiology_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Microbiology">
                                <div class="group-input">
                                    <label for="Microbiology assessment">Impact Assessment (By Microbiology)</label>
                                    <textarea class="summernote Microbiology_assessment" name="Microbiology_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Microbiology">
                                <div class="group-input">
                                    <label for="Microbiology feedback">Microbiology Feedback</label>
                                    <textarea class="summernote Microbiology_feedback" name="Microbiology_feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 Microbiology">
                                <div class="group-input">
                                    <label for="Microbiology attachment">Microbiology Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Microbiology_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Microbiology_attachment[]"
                                                oninput="addMultipleFiles(this, 'Microbiology_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 Microbiology">
                                <div class="group-input">
                                    <label for="Microbiology Completed By">Microbiology Completed By</label>
                                    <input readonly type="text" name="Microbiology_by" id="Microbiology_by">
                                </div>
                            </div>
                            <div class="col-lg-6 Microbiology">
                                <div class="group-input ">
                                    <label for="Microbiology Completed On">Microbiology Completed On</label>
                                    <input type="date" id="Microbiology_on" name="Microbiology_on">
                                </div>
                            </div>


                            <div class="sub-head">
                                Safety
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.environmental_health').hide();

                                    $('[name="Environment_Health_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.environmental_health').show();
                                            $('.environmental_health span').show();
                                        } else {
                                            $('.environmental_health').hide();
                                            $('.environmental_health span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Safety Review Required">Safety Review Required
                                        ?</label>
                                    <select name="Environment_Health_review" id="Environment_Health_review" disabled>
                                        <option value="0">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 30, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 environmental_health">
                                <div class="group-input">
                                    <label for="Safety Person"> Safety Person</label>
                                    <select name="Environment_Health_Safety_person"
                                        id="Environment_Health_Safety_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 environmental_health">
                                <div class="group-input">
                                    <label for="Impact Assessment8">Impact Assessment (By Safety)</label>
                                    <textarea class="" name="Health_Safety_assessment" id="summernote-33">
                                            </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 environmental_health">
                                <div class="group-input">
                                    <label for="productionfeedback">Safety Feedback</label>
                                    <textarea class="" name="Health_Safety_feedback" id="summernote-34">
                                            </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 environmental_health">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Safety Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Environment_Health_Safety_attachment">
                                        </div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile"
                                                name="Environment_Health_Safety_attachment[]"
                                                oninput="addMultipleFiles(this, 'Environment_Health_Safety_attachment')"
                                                multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 environmental_health">
                                <div class="group-input">
                                    <label for="productionfeedback">Safety Review Completed
                                        By</label>
                                    <input type="text" name="Environment_Health_Safety_by"
                                        id="Environment_Health_Safety_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field environmental_health">
                                <div class="group-input input-date">
                                    <label for="Safety Review Completed On">Safety Review
                                        Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Environment_Health_Safety_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        <input type="date" name="Environment_Health_Safety_on"
                                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                            oninput="handleDateInput(this, 'Environment_Health_Safety_on')" />
                                    </div>
                                </div>
                            </div>
                            <div class="sub-head">
                                Contract Giver
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.ContractGiver').hide();

                                    $('[name="ContractGiver_Review"]').change(function() {
                                        if ($(this).val() === 'yes') {

                                            $('.ContractGiver').show();
                                            $('.ContractGiver span').show();
                                        } else {
                                            $('.ContractGiver').hide();
                                            $('.ContractGiver span').hide();
                                        }
                                    });
                                });
                            </script>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Contract Giver"> Contract Giver Required ? </label>
                                    <select name="ContractGiver_Review" id="ContractGiver_Review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value='yes'>
                                            Yes</option>
                                        <option value='no'>
                                            No</option>
                                        <option value='na'>
                                            NA</option>
                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 22, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 store">
                                <div class="group-input">
                                    <label for="Contract Giver notification">Contract Giver Person</label>
                                    <select name="ContractGiver_Person" class="ContractGiver_Person"
                                        id="ContractGiver_Person">
                                        <option value="">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 store">
                                <div class="group-input">
                                    <label for="Contract Giver assessment">Impact Assessment (By Contract
                                        Giver)</label>
                                    <textarea class="summernote ContractGiver_assessment" name="ContractGiver_assessment" id="summernote-17"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 store">
                                <div class="group-input">
                                    <label for="Contract Giver feedback">Contract Giver Feedback</label>
                                    <textarea class="summernote ContractGiver_feedback" name="ContractGiver_feedback" id="summernote-18"></textarea>
                                </div>
                            </div>
                            <div class="col-12 store">
                                <div class="group-input">
                                    <label for="Contract Giver attachment">Contract Giver Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="ContractGiver_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="ContractGiver_attachment[]"
                                                oninput="addMultipleFiles(this, 'ContractGiver_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 store">
                                <div class="group-input">
                                    <label for="Contract Giver Completed By">Contract Giver Completed
                                        By</label>
                                    <input readonly type="text" name="ContractGiver_by" id="ContractGiver_by">
                                </div>
                            </div>
                            <div class="col-lg-6 store">
                                <div class="group-input ">
                                    <label for="Contract Giver Completed On">Contract Giver Completed On</label>
                                    <input type="date"id="ContractGiver_on" name="ContractGiver_on">
                                </div>
                            </div>







                            <script>
                                $(document).ready(function() {
                                    $('.other1_reviews').hide();

                                    $('[name="Other1_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.other1_reviews').show();
                                            $('.other1_reviews span').show();
                                        } else {
                                            $('.other1_reviews').hide();
                                            $('.other1_reviews span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Other's 1 ( Additional Person Review From Departments If Required)
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 1 Review Required ?</label>
                                    <select name="Other1_review" id="Other1_review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 34, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 other1_reviews">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 1 Person</label>
                                    <select name="Other1_person" id="Other1_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12 other1_reviews">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 1 Department</label>
                                    <select name="Other1_Department_person" id="Other1_Department_person">
                                        <option value="0">-- Select --</option>
                                        <option value="Production">Production</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Quality_Control">Quality Control</option>
                                        <option value="Quality_Assurance">Quality Assurance</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Analytical_Development_Laboratory">Analytical Development
                                            Laboratory</option>
                                        <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                            Lab</option>
                                        <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                        <option value="Environment, Health & Safety">Environment, Health & Safety
                                        </option>
                                        <option value="Human Resource & Administration">Human Resource &
                                            Administration</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Regulatory Affairs">Project management</option>



                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 other1_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Impact Assessment (By Other's 1)</label>
                                    <textarea class="" name="Other1_assessment" id="summernote-41">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 other1_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback"> Other's 1 Feedback</label>
                                    <textarea class="" name="Other1_feedback" id="summernote-42">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 other1_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Other's 1 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Other1_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Other1_attachment[]"
                                                oninput="addMultipleFiles(this, 'Other1_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 other1_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback"> Other's 1 Review Completed By</label>
                                    <input type="text" name="Other1_by" id="Other1_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field other1_reviews">
                                <div class="group-input input-date">
                                    <label for="Review Completed On1">Other's 1 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other1_on" name="Other1_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.Other2_reviews').hide();

                                    $('[name="Other2_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.Other2_reviews').show();
                                            $('.Other2_reviews span').show();
                                        } else {
                                            $('.Other2_reviews').hide();
                                            $('.Other2_reviews span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Other's 2 ( Additional Person Review From Departments If Required)
                            </div>
                            <div class="col-lg-6 ">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 2 Review Required ?</label>
                                    <select name="Other2_review" id="Other2_review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 35, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 Other2_reviews">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 2 Person</label>
                                    <select name="Other2_person" id="Other2_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12 Other2_reviews">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 2 Department</label>
                                    <select name="Other2_Department_person" id="Other2_Department_person">
                                        <option value="0">-- Select --</option>
                                        <option value="Production">Production</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Quality_Control">Quality Control</option>
                                        <option value="Quality_Assurance">Quality Assurance</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Analytical_Development_Laboratory">Analytical Development
                                            Laboratory</option>
                                        <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                            Lab</option>
                                        <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                        <option value="Environment, Health & Safety">Environment, Health & Safety
                                        </option>
                                        <option value="Human Resource & Administration">Human Resource &
                                            Administration</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Project management">Project management</option>



                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment13">Impact Assessment (By Other's 2)</label>
                                    <textarea class="" name="Other2_Assessment" id="summernote-43">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Feedback2"> Other's 2 Feedback</label>
                                    <textarea class="" name="Other2_feedback" id="summernote-44">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 Other2_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Other's 2 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Other2_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Other2_attachment[]"
                                                oninput="addMultipleFiles(this, 'Other2_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 Other2_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By2"> Other's 2 Review Completed By</label>
                                    <input type="text" name="Other2_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field Other2_reviews">
                                <div class="group-input input-date">
                                    <label for="Review Completed On2">Other's 2 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other2_on" name="Other2_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        {{-- <input type="date"  name="Other2_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Other2_on')" /> --}}
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.Other3_reviews').hide();

                                    $('[name="Other3_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.Other3_reviews').show();
                                            $('.Other3_reviews span').show();
                                        } else {
                                            $('.Other3_reviews').hide();
                                            $('.Other3_reviews span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Other's 3 ( Additional Person Review From Departments If Required)
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 3 Review Required ?</label>
                                    <select name="Other3_review" id="Other3_review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 36, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 Other3_reviews">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 3 Person</label>
                                    <select name="Other3_person" id="Other3_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12 Other3_reviews ">
                                <div class="group-input">
                                    <label for="Customer notification"> Other's 3 Department</label>
                                    <select name="Other3_Department_person" id="Other3_Department_person">
                                        <option value="0">-- Select --</option>
                                        <option value="Production">Production</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Quality_Control">Quality Control</option>
                                        <option value="Quality_Assurance">Quality Assurance</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Analytical_Development_Laboratory">Analytical Development
                                            Laboratory</option>
                                        <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                            Lab</option>
                                        <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                        <option value="Environment, Health & Safety">Environment, Health & Safety
                                        </option>
                                        <option value="Human Resource & Administration">Human Resource &
                                            Administration</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Project management">Project management</option>



                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Impact Assessment (By Other's 3)</label>
                                    <textarea class="" name="Other3_Assessment" id="summernote-45">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback"> Other's 3 Feedback</label>
                                    <textarea class="" name="Other3_feedback" id="summernote-46">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 Other3_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Other's 3 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Other3_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Other3_attachment[]"
                                                oninput="addMultipleFiles(this, 'Other3_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 Other3_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback"> Other's 3 Review Completed By</label>
                                    <input type="text" name="Other3_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field Other3_reviews">
                                <div class="group-input input-date">
                                    <label for="Review Completed On3">Other's 3 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other3_on" name="Other3_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        {{-- <input type="date"  name="Other3_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Other3_on')" /> --}}
                                    </div>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    $('.Other4_reviews').hide();

                                    $('[name="Other4_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.Other4_reviews').show();
                                            $('.Other4_reviews span').show();
                                        } else {
                                            $('.Other4_reviews').hide();
                                            $('.Other4_reviews span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Other's 4 ( Additional Person Review From Departments If Required)
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review4"> Other's 4 Review Required ?</label>
                                    <select name="Other4_review" id="Other4_review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 37, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 Other4_reviews">
                                <div class="group-input">
                                    <label for="Person4"> Other's 4 Person</label>
                                    <select name="Other4_person" id="Other4_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12 Other4_reviews">
                                <div class="group-input">
                                    <label for="Department4"> Other's 4 Department</label>
                                    <select name="Other4_Department_person" id="Other4_Department_person">
                                        <option value="0">-- Select --</option>
                                        <option value="Production">Production</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Quality_Control">Quality Control</option>
                                        <option value="Quality_Assurance">Quality Assurance</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Analytical_Development_Laboratory">Analytical Development
                                            Laboratory</option>
                                        <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                            Lab</option>
                                        <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                        <option value="Environment, Health & Safety">Environment, Health & Safety
                                        </option>
                                        <option value="Human Resource & Administration">Human Resource &
                                            Administration</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Project management">Project management</option>



                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="Impact Assessment15">Impact Assessment (By Other's 4)</label>
                                    <textarea class="" name="Other4_Assessment" id="summernote-47">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="feedback4"> Other's 4 Feedback</label>
                                    <textarea class="" name="Other4_feedback" id="summernote-48">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 Other4_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Other's 4 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Other4_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Other4_attachment[]"
                                                oninput="addMultipleFiles(this, 'Other4_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 Other4_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By4"> Other's 4 Review Completed By</label>
                                    <input type="text" name="Other4_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field Other4_reviews">
                                <div class="group-input input-date">
                                    <label for="Review Completed On4">Other's 4 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other4_on" name="Other4_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        {{-- <input type="date"  name="Other4_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Other4_on')" /> --}}
                                    </div>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('.Other5_reviews').hide();

                                    $('[name="Other5_review"]').change(function() {
                                        if ($(this).val() === 'yes') {
                                            $('.Other5_reviews').show();
                                            $('.Other5_reviews span').show();
                                        } else {
                                            $('.Other5_reviews').hide();
                                            $('.Other5_reviews span').hide();
                                        }
                                    });
                                });
                            </script>
                            <div class="sub-head">
                                Other's 5 ( Additional Person Review From Departments If Required)
                            </div>
                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="review5"> Other's 5 Review Required ?</label>
                                    <select name="Other5_review" id="Other5_review" disabled>
                                        <option value="">-- Select --</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        <option value="na">NA</option>

                                    </select>

                                </div>
                            </div>
                            @php
                                $division = DB::table('q_m_s_divisions')
                                    ->where('name', Helpers::getDivisionName(session()->get('division')))
                                    ->first();
                                $userRoles = DB::table('user_roles')
                                    ->where(['q_m_s_roles_id' => 38, 'q_m_s_divisions_id' => $division->id])
                                    ->get();
                                $userRoleIds = $userRoles->pluck('user_id')->toArray();
                                $users = DB::table('users')->whereIn('id', $userRoleIds)->get(); // Fetch user data based on user IDs
                            @endphp
                            <div class="col-lg-6 Other5_reviews">
                                <div class="group-input">
                                    <label for="Person5">Other's 5 Person</label>
                                    <select name="Other5_person" id="Other5_person">
                                        <option value="0">-- Select --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Department5"> Other's 5 Department</label>
                                    <select name="Other5_Department_person" id="Other5_Department_person">
                                        <option value="0">-- Select --</option>
                                        <option value="Production">Production</option>
                                        <option value="Warehouse">Warehouse</option>
                                        <option value="Quality_Control">Quality Control</option>
                                        <option value="Quality_Assurance">Quality Assurance</option>
                                        <option value="Engineering">Engineering</option>
                                        <option value="Analytical_Development_Laboratory">Analytical Development
                                            Laboratory</option>
                                        <option value="Process_Development_Lab">Process Development Laboratory / Kilo
                                            Lab</option>
                                        <option value="Technology transfer/Design">Technology Transfer/Design</option>
                                        <option value="Environment, Health & Safety">Environment, Health & Safety
                                        </option>
                                        <option value="Human Resource & Administration">Human Resource &
                                            Administration</option>
                                        <option value="Information Technology">Information Technology</option>
                                        <option value="Project management">Project management</option>



                                    </select>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback">Impact Assessment (By Other's 5)</label>
                                    <textarea class="" name="Other5_Assessment" id="summernote-49">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="productionfeedback"> Other's 5 Feedback</label>
                                    <textarea class="" name="Other5_feedback" id="summernote-50">
                            </textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 Other5_reviews">
                                <div class="group-input">
                                    <label for="Audit Attachments"> Other's 5 Attachments</label>
                                    <div><small class="text-primary">Please Attach all relevant or supporting
                                            documents</small></div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="Other5_attachment"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="myfile" name="Other5_attachment[]"
                                                oninput="addMultipleFiles(this, 'Other5_attachment')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 Other5_reviews">
                                <div class="group-input">
                                    <label for="Review Completed By5"> Other's 5 Review Completed By</label>
                                    <input type="text" name="Other5_by" disabled>

                                </div>
                            </div>
                            <div class="col-lg-6 new-date-data-field Other5_reviews">
                                <div class="group-input input-date">
                                    <label for="Review Completed On5">Other's 5 Review Completed On</label>
                                    <div class="calenderauditee">
                                        <input type="text" id="Other5_on" name="Other5_on" readonly
                                            placeholder="DD-MMM-YYYY" />
                                        {{-- <input type="date"  name="Other5_on" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'Other5_on')" /> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" id="ChangesaveButton"
                                style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                class="saveButton">Save</button>
                            {{-- <a href="/rcms/qms-dashboard"
                        style=" justify-content: center; width: 4rem; margin-left: 1px;">
                        <button type="button" class="backButton">Back</button>
                    </a> --}}
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;"
                                id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button" style=" justify-content: center; width: 4rem; margin-left: 1px;">
                                <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                            <!-- <a style="  justify-content: center; width: 10rem; margin-left: 1px;" type="button"
                                                                                    class="button  launch_extension" data-bs-toggle="modal"
                                                                                    data-bs-target="#launch_extension">
                                                                                    Launch Extension
                                                                                </a> -->
                            {{-- <a type="button" class="button  launch_extension" data-bs-toggle="modal"
                            data-bs-target="#effectivenss_extension">
                            Launch Effectiveness Check
                        </a> --}}
                        </div>

                    </div>
                </div>






                <div id="CCForm5" class="inner-block cctabcontent">
                    <div class="inner-block-content">

                        <div class="row">
                            <div class="sub-head">
                                Activity Log
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">Submit By : </label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Submit On : </label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment : </label>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">QA/CQA Head Review by : </label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">QA/ CQA Head Review On :</label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">Cancel By :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Cancel On :</label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment</label>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">Send CFT By : </label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Send CFT On :</label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="group-input">
                                    <label for="Initiator Group">Quality Control Completed By :</label>
                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Quality Control Completed On :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">QA CQA Verify Complete By :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">QA CQA Verify Complete On :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Reject By :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Reject On :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Approve Plan By :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Approve Plan On :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Send Letter By :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Send Letter On :</label>

                                </div>
                            </div>

                            <div class="col-lg-6 new-date-data-field">
                                <div class="group-input input-date">
                                    <label for="OOC Logged On">Comment :</label>

                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm4" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            Closure
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Closure Comment">Closure Comment</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" name="closure_comment_c" id="summernote-1">
                            </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">Closure Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="initial_attachment_c"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="initial_attachment_c"
                                                name="initial_attachment_c[]"
                                                oninput="addMultipleFiles(this,'initial_attachment_c')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton" id="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>

                <div id="CCForm7" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            All Action Completion Verification by QA/CQA
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Closure Comment">QA/CQA  Comment</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" name="qa_cqa_comments" id="qa_cqa_comments">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA/CQA Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="qa_cqa_attachments"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="qa_cqa_attachments" name="qa_cqa_attachments[]"
                                                oninput="addMultipleFiles(this,'qa_cqa_attachments')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>


                <div id="CCForm8" class="inner-block cctabcontent">
                    <div class="inner-block-content">
                        <div class="sub-head">
                            QA/CQA Head Approval
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="group-input">
                                    <label for="Closure Comment">QA/CQA Head Approval Comment</label>
                                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                                            require completion</small></div>
                                    <textarea class="summernote" name="qa_cqa_head_comm" id="qa_cqa_head_comm">
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="group-input">
                                    <label for="Inv Attachments">QA/CQA Head Approval Attachment</label>
                                    <div>
                                        <small class="text-primary">
                                            Please Attach all relevant or supporting documents
                                        </small>
                                    </div>
                                    <div class="file-attachment-field">
                                        <div class="file-attachment-list" id="qa_cqa_head_attach"></div>
                                        <div class="add-btn">
                                            <div>Add</div>
                                            <input type="file" id="qa_cqa_head_attach" name="qa_cqa_head_attach[]"
                                                oninput="addMultipleFiles(this,'qa_cqa_head_attach')" multiple>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <button type="button" class="backButton" onclick="previousStep()">Back</button>
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>

                            <button type="button"> <a class="text-white" href="{{ url('rcms/qms-dashboard') }}">Exit
                                </a> </button>
                        </div>
                    </div>
                </div>
        </div>
        </form>

    </div>
    </div>

    <style>
        #step-form>div {
            display: none
        }

        #step-form>div:nth-child(1) {
            display: block;
        }
    </style>

    <script>
        VirtualSelect.init({
            ele: '#related_records, #hod'
        });


        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
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
        const stepButtons = document.querySelectorAll(".cctablinks");
        const steps = document.querySelectorAll(".cctabcontent");
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

                // Update current stepkmlkmlmkmklm
                currentStep--;
            }
        }
    </script>
    <script>
        VirtualSelect.init({
            ele: '#reference_record, #notify_to'
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

    {{-- <script>
        function handleDateInput(inputElement, hiddenInputId) {
            const hiddenInput = document.getElementById(hiddenInputId);
            const displayElement = document.getElementById(`display_${hiddenInputId}`);

            hiddenInput.value = inputElement.value;

            // Update the displayed date
            if (inputElement.value) {
                const date = new Date(inputElement.value);
                const formattedDate = date.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                }).toUpperCase();
                displayElement.textContent = formattedDate;
            }
        }
    </script> --}}

    <script>
        function handleDateInputTest(dateInput, displayInputId) {
            const displayInput = document.getElementById(displayInputId);

            if (dateInput.value) {
                const date = new Date(dateInput.value);
                const formattedDate = date.toLocaleDateString('en-GB', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                }).toUpperCase();
                displayInput.value = formattedDate;
            } else {
                displayInput.value = '';
            }
        }
    </script>

    {{-- <script>
    document.getElementById('initiator_group').addEventListener('change', function() {
        var selectedValue = this.value;
        document.getElementById('initiator_group_code').value = selectedValue;
    });

    function setCurrentDate(item){
        if(item == 'yes'){
            $('#effect_check_date').val('{{ date('d-M-Y')}}');
        }
        else{
            $('#effect_check_date').val('');
        }
    }
</script> --}}




    {{-- ---------------------======================record number script  --}}
    {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
var originalRecordNumber = document.getElementById('record').value;
var initialPlaceholder = '---';

document.getElementById('initiator_group').addEventListener('change', function() {
    var selectedValue = this.value;
    var recordNumberElement = document.getElementById('record');
    var initiatorGroupCodeElement = document.getElementById('initiator_group_code');

    // Update the initiator group code
    initiatorGroupCodeElement.value = selectedValue;

    // Update the record number by replacing the initial placeholder with the selected initiator group code
    var newRecordNumber = originalRecordNumber.replace(initialPlaceholder, selectedValue);
    recordNumberElement.value = newRecordNumber;

    // Update the original record number to keep track of changes
    originalRecordNumber = newRecordNumber;
    initialPlaceholder = selectedValue;
});
});

</script> --}}
@endsection
