<div id="CCForm1" class="inner-block cctabcontent">
    <div class="inner-block-content">

        <div class="sub-head">General Information</div>
        <div class="row">
            <div class="col-lg-6 new-time-data-field">
                <div class="group-input input-time">
                    <label for="Initiator Group">Type</label>
                    <select disabled name="Form_type" {{Helpers::isOOSChemical($data->stage)}}>
                        <option value="">--Select---</option>
                        <option value="OOS_Chemical" {{ $data->Form_type == 'OOS_Chemical' ? 'selected' : '' }}>OOS Chemical</option>
                        <option value="OOS_Micro" {{ $data->Form_type == 'OOS_Micro' ? 'selected' : '' }}>OOS Micro</option>
                        <option value="OOT" {{ $data->Form_type == 'OOT' ? 'selected' : '' }}>OOT</option>
                    </select>
                </div>
            </div>
            
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator"> Record Number </label>
                    <input disabled type="text" id="record" name="record"
                           value="{{ Helpers::getDivisionName($data->division_id) }}/{{ $data->Form_type }}/20{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number, 4, '0', STR_PAD_LEFT) : '1' }}">
                </div>
            </div>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                var formType = "{{ $data->Form_type }}";
                var divisionName = "{{ Helpers::getDivisionName($data->division_id) }}";
                var year = "{{ Helpers::year($data->created_at) }}";
                var recordNumber = "{{ $data->record_number ? str_pad($data->record_number, 4, '0', STR_PAD_LEFT) : '1' }}";
            
                // Determine the record text based on the form type
                var recordText = divisionName + '/' + formType + '/' + year + '/' + recordNumber;
            
                // Display the correct button group
                if (formType === 'OOS_Chemical') {
                    document.getElementById('OOS_Chemical_Buttons').style.display = 'block';
                } else if (formType === 'OOS_Micro') {
                    document.getElementById('OOS_Micro_Buttons').style.display = 'block';
                } else if (formType === 'OOT') {
                    document.getElementById('OOT_Buttons').style.display = 'block';
                }
            
                // Update the Record Number display
                document.getElementById('record').value = recordText;
            });
            </script>
            
            <div class="col-lg-6">
                <div class="group-input">
                    <label disabled for="Short Description">Division Code<span
                            class="text-danger"></span></label>
                    <input disabled type="text" name="division_code"
                        value="{{ Helpers::getDivisionName($data->division_id) }}">
                    <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Initiator <span class="text-danger"></span></label>
                    <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}">
                </div>
            </div>
            
            <div class="col-md-6 ">
                <div class="group-input ">
                    <label for="due-date"> Date Of Initiation<span class="text-danger"></span></label>
                    <input disabled type="text" value="{{ Helpers::getdateFormat($data['intiation_date'] ?? '') }}" name="intiation_date">
                    <input type="hidden" value="{{ $data->intiation_date }}" name="intiation_date">
                </div>
            </div>
                
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Date Due"> Due Date </label>
                    <div><small class="text-primary">If revising Due Date, kindly mention revision reason in "Due Date Extension Justification" data field.</small></div>
                    <div class="calenderauditee">
                        <input  type="text" name="due_date" id="due_date" readonly placeholder="DD-MMM-YYYY"  value="{{ Helpers::getdateFormat($data->due_date) }}"/>
                        <input  type="date" name="due_date"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                            oninput="handleDateInput(this, 'due_date')" {{ $data->stage == 1 ? '' : '' }} />
                    </div>
                    
                </div>
            </div>
            {{-- <div class="col-md-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="due-date">Due Date</label>
                    <div><small class="text-primary">Please mention expected date of completion</small></div>
                    <div class="calenderauditee">
                    <div class="calenderauditee">
                        <input readonly type="text" value="{{ Helpers::getdateFormat($micro_data->due_date) }}" name="due_date" id="due_date" />
                        <input type="date" disabled name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'due_date')" />
                    </div>
                    </div>
                </div>
            </div> --}}
            {{-- <script>
                // Format the due date to DD-MM-YYYY
                // Your input date
                var dueDate = "{{ $dueDate }}"; // Replace {{ $dueDate }} with your actual date variable
    
                // Create a Date object
                var date = new Date(dueDate);
    
                // Array of month names
                var monthNames = [
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                ];
    
                // Extracting day, month, and year from the date
                var day = date.getDate().toString().padStart(2, '0'); // Ensuring two digits
                var monthIndex = date.getMonth();
                var year = date.getFullYear();
    
                // Formatting the date in "dd-MMM-yyyy" format
                var dueDateFormatted = `${day}-${monthNames[monthIndex]}-${year}`;
    
                // Set the formatted due date value to the input field
                document.getElementById('due_date').value = dueDateFormatted;
            </script> --}}

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Short Description">Short Description
                        <span class="text-danger">*</span></label>
                        <span id="rchars">255</span>characters remaining
                        <input id="docname"  name="description_gi" maxlength="255" required {{Helpers::isOOSChemical($data->stage)}} value="{{ $data->description_gi }}" {{ $data->stage == 1 ? '' : 'disabled' }}>
                            
                </div>
            </div>
            <p id="docnameError" style="color:red">**Short Description is required</p>
                        
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description"> Initiation department Group <span
                            class="text-danger"></span></label>
                    <select name="initiator_group" id="initiator_group"  {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                        <option value="">-- Select --</option>
                                                        <option value="CQA"
                                                            @if ($data->initiator_group == 'CQA') selected @endif>Corporate Quality Assurance</option>
                                                        <option value="QA"
                                                            @if ($data->initiator_group == 'QA') selected @endif>Quality Assurance</option>
                                                        <option value="QC"
                                                            @if ($data->initiator_group == 'QC') selected @endif>Quality Control</option>
                                                        <option value="QM"
                                                            @if ($data->initiator_group == 'QM') selected @endif>Quality Control (Microbiology department)
                                                        </option>
                                                        <option value="PG"
                                                            @if ($data->initiator_group == 'PG') selected @endif>Production General</option>
                                                        <option value="PL"
                                                            @if ($data->initiator_group == 'PL') selected @endif>Production Liquid Orals</option>
                                                        <option value="PT"
                                                            @if ($data->initiator_group == 'PT') selected @endif>Production Tablet and Powder</option>
                                                        <option value="PE"
                                                            @if ($data->initiator_group == 'PE') selected @endif>Production External (Ointment, Gels, Creams and Liquid)</option>
                                                        <option value="PC"
                                                            @if ($data->initiator_group == 'PC') selected @endif>Production Capsules</option>
                                                        <option value="PI"
                                                            @if ($data->initiator_group == 'PI') selected @endif>Production Injectable</option>
                                                        <option value="EN"
                                                            @if ($data->initiator_group == 'EN') selected @endif>Engineering</option>
                                                        <option value="HR"
                                                            @if ($data->initiator_group == 'HR') selected @endif>Human Resource</option>
                                                        <option value="ST"
                                                            @if ($data->initiator_group == 'ST') selected @endif>Store</option>
                                                        <option value="IT"
                                                            @if ($data->initiator_group == 'IT') selected @endif>Electronic Data Processing
                                                        </option>
                                                        <option value="FD"
                                                            @if ($data->initiator_group == 'FD') selected @endif>Formulation  Development
                                                        </option>
                                                        <option value="AL"
                                                            @if ($data->initiator_group == 'AL') selected @endif>Analytical research and Development Laboratory
                                                        </option>
                                                        <option value="PD"
                                                            @if ($data->initiator_group == 'PD') selected @endif>Packaging Development
                                                        </option>

                                                        <option value="PU"
                                                            @if ($data->initiator_group == 'PU') selected @endif>Purchase Department
                                                        </option>
                                                        <option value="DC"
                                                            @if ($data->initiator_group == 'DC') selected @endif>Document Cell
                                                        </option>
                                                        <option value="RA"
                                                            @if ($data->initiator_group == 'RA') selected @endif>Regulatory Affairs
                                                        </option>
                                                        <option value="PV"
                                                            @if ($data->initiator_group == 'PV') selected @endif>Pharmacovigilance
                                                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Initiation department Code <span
                            class="text-danger"></span></label>
                    <input type="text" name="initiator_group_code"  id="initiator_group_code" readonly
                        value="{{ $data->initiator_group_code ?? '' }}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group Code">If Others</label>
                    <textarea type="if_others_gi" name="if_others_gi" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>{{ $data->if_others_gi }}</textarea>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">Is Repeat?</label>
                    <select name="is_repeat_gi" id="assignableSelect" {{ $data->stage == 1 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data->is_repeat_gi == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data->is_repeat_gi == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            
            <div class="col-lg-6" id="rootCauseGroup" style="display: none;">
                <div class="group-input">
                    <label for="RootCause">Repeat Nature<span class="text-danger">*</span></label>
                    <textarea name="repeat_nature" id="rootCauseTextarea" rows="4" placeholder="Describe the Is Repeat here" {{ $data->stage == 1 ? '' : 'disabled' }}>{{ $data->repeat_nature }}</textarea>
                </div>
            </div>
            
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Initialize the display of the textarea based on the current value
                toggleRootCauseInput(); 
            
                function toggleRootCauseInput() {
                    var selectValue = document.getElementById("assignableSelect").value.toLowerCase(); // Convert value to lowercase for consistency
                    var rootCauseGroup = document.getElementById("rootCauseGroup");
                    var rootCauseTextarea = document.getElementById("rootCauseTextarea");
            
                    if (selectValue === "yes") {
                        rootCauseGroup.style.display = "block";  // Show the textarea if "Yes" is selected
                        rootCauseTextarea.setAttribute('required', 'required');  // Make textarea required
                    } else {
                        rootCauseGroup.style.display = "none";   // Hide the textarea if "No" is selected
                        rootCauseTextarea.removeAttribute('required');  // Remove required attribute
                    }
                }
            
                // Attach the event listener
                document.getElementById("assignableSelect").addEventListener("change", toggleRootCauseInput);
            });
            </script>
            
            
            
            {{-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Repeat Nature</label>
                    <textarea type="text" name="repeat_nature_gi" {{Helpers::isOOSChemical($data->stage)}}>{{ $data->repeat_nature_gi }}</textarea>
                </div>
            </div>
           <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Nature of Change</label>
                    <select name="nature_of_change_gi" {{Helpers::isOOSChemical($data->stage)}}>
                      <option value="0" {{ $data->nature_of_change_gi == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="temporary" {{ $data->nature_of_change_gi == 'temporary' ?
                            'selected' : '' }}>temporary</option>
                        <option value="permanent" {{ $data->nature_of_change_gi == 'permanent' ?
                            'selected' : '' }}>permanent</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Source Document Type</label>
                    <select name="source_document_type_gi" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                        <option value="0">Enter Your Selection Here</option>
                        <option value="OOT" @if ($data->source_document_type_gi == 'oot') selected @endif>OOT</option>
                        <option value="Lab Incident" @if ($data->source_document_type_gi == 'Lab Incident') selected @endif>Lab Incident</option>
                        <option value="Deviation" @if ($data->source_document_type_gi == 'Deviation') selected @endif>Deviation</option>
                        <option value="Product Non-conformance" @if ($data->source_document_type_gi == 'Product Non-conformance') selected @endif>Product Non-conformance</option>
                        <option value="Inspectional Observation" @if ($data->source_document_type_gi == 'Inspectional Observation') selected @endif>Inspectional Observation</option>
                        <option value="Others" @if ($data->source_document_type_gi == 'Others') selected @endif>Others</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference System Document</label>
                    <input type="text" name="reference_system_document_gi"  id="reference_system_document_gi" 
                        value="{{ $data->reference_system_document_gi ?? '' }}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="reference_document">Reference document</label>
                    <input type="text" name="reference_document"  id="reference_document" 
                        value="{{ $data->reference_document ?? '' }}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="oos Occurred On"> OOS occurred On </label>
                    <div><small class="text-primary"></small></div>
                    <div class="calenderauditee">
                        <input type="text" id="deviation_occured_on_gi" readonly 
                        value="{{ Helpers::getdateFormat($data['deviation_occured_on_gi'] ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY" {{ $data->stage == 1 ? '' : 'disabled' }} />
                        <input type="date" name="deviation_occured_on_gi"
                         class="hide-input" oninput="handleDateInput(this, 'deviation_occured_on_gi')" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Deviation Occurred On"> OOS Observed On </label>
                    <div><small class="text-primary"></small></div>
                    <div class="calenderauditee">
                        <input type="text" id="oos_observed_on" readonly value="{{ Helpers::getdateFormat($data['oos_observed_on'] ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="oos_observed_on" class="hide-input" oninput="handleDateInput(this, 'oos_observed_on')" {{ $data->stage == 1 ? '' : 'disabled' }} />
                    </div>
                </div>
            </div>
            <div class="col-lg-12 new-time-data-field">
                {{-- @error('delay_justification') @else delayJustificationBlock @enderror --}}
                <div class="group-input input-time ">
                    <label for="deviation_time">Delay Justification <span class="text-danger">*</span></label>
                    <textarea id="delay_justification" name="delay_justification" {{ $data->stage == 1 ? '' : 'disabled' }}>{{ $data->delay_justification }}</textarea>
                </div>
                @error('delay_justification')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <script>
                flatpickr("#deviation_time", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i", // 24-hour format without AM/PM
                    minuteIncrement: 1 // Set minute increment to 1

                });
            </script>
            
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Deviation Occurred On"> OOS Reported On </label>
                    <div><small class="text-primary"></small></div>
                    <div class="calenderauditee">
                        <input type="text" id="oos_reported_date" readonly 
                        value="{{ Helpers::getdateFormat($data['oos_reported_date'] ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="oos_reported_date" class="hide-input" oninput="handleDateInput(this, 'oos_reported_date')" {{ $data->stage == 1 ? '' : 'disabled' }}/>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    // Hide the delayJustificationBlock initially
                    $('.delayJustificationBlock').hide();

                    // Check the condition on page load
                    checkDateDifference();
                });

                function checkDateDifference() {
                    let deviationDate = $('input[name=Deviation_date]').val();
                    let reportedDate = $('input[name=Deviation_reported_date]').val();

                    if (!deviationDate || !reportedDate) {
                        console.error('Deviation date or reported date is missing.');
                        return;
                    }

                    let deviationDateMoment = moment(deviationDate);
                    let reportedDateMoment = moment(reportedDate);

                    let diffInDays = reportedDateMoment.diff(deviationDateMoment, 'days');

                    // if (diffInDays > 0) {
                    //     $('.delayJustificationBlock').show();
                    // } else {
                    //     $('.delayJustificationBlock').hide();
                    // }
                }

                // Call checkDateDifference whenever the values are changed
                $('input[name=Deviation_date], input[name=Deviation_reported_date]').on('change', function() {
                    checkDateDifference();
                });
                </script>


            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Immediate action">Immediate Action</label>
                        <textarea name="immediate_action" id="immediate_action" {{ Helpers::isOOSChemical($data->stage) }} {{ $data->stage == 1 ? '' : 'disabled' }}>{{ $data->immediate_action ?? '' }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group">Initial Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>

                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="initial_attachment_gi">
                            @if ($data->initial_attachment_gi)
                            @foreach ($data->initial_attachment_gi as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark"
                                        style="color:red; font-size:20px;"></i></a>
                            </h6>
                            @endforeach
                            @endif
                        </div>

                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="initial_attachment_gi[]" 
                            oninput="addMultipleFiles(this, 'initial_attachment_gi')"
                            {{ $data->stage == 1 ? '' : 'disabled' }}  multiple     {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-head pt-3">OOS Information</div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Sample Type</label>
                    <select name="sample_type_gi"  {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Raw Material"{{ $data->sample_type_gi == 'Raw Materia' ?
                            'selected' : '' }}>Raw Material</option>
                        <option value="Packing Material"{{ $data->sample_type_gi == 'Packing Material' ?
                            'selected' : '' }}>Packing Material</option>
                        <option value="Finished Product"{{ $data->sample_type_gi == 'Finished Product' ?
                            'selected' : '' }}>Finished Product</option>
                        <option value="Satbility Sample"{{ $data->sample_type_gi == 'Satbility Sample' ?
                            'selected' : '' }}>Satbility Sample</option>
                        <option value="Others"{{ $data->sample_type_gi == 'Others' ?
                            'selected' : '' }}>Others</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Product / Material Name</label>
                    <input type="text" value="{{$data->product_material_name_gi}}"
                        name="product_material_name_gi" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Market</label>
                    <input type="text" name="market_gi" value="{{$data->market_gi}}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Customer</label>
                    <input type="text" name="customer_gi" value="{{$data->customer_gi}}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Specification Details</label>
                    <input type="text" name="specification_details" value="{{$data->specification_details}}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">STP Details</label>
                    <input type="text" name="STP_details" value="{{$data->STP_details}}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Manufacture/Vendor</label>
                    <input type="text" name="manufacture_vendor" value="{{$data->manufacture_vendor}}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 1 ? '' : 'disabled' }}>
                </div>
            </div>
            
            <!-- ---------------------------grid-1 -------------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="info_product_material" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="info_product_material_details"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 2%">Row#</th>
                                <th style="width: 6%">Item/Product Code</th>
                                <th style="width: 8%"> Batch No*.</th>
                                <th style="width: 18%"> Mfg.Date</th>
                                <th style="width: 18%">Expiry Date</th>
                                <th style="width: 8%"> Label Claim.</th>
                                <th style="width: 8%">Pack Size</th>
                                <th style="width: 8%">Analyst Name</th>
                                <th style="width: 10%">Others (Specify)</th>
                                <th style="width: 10%"> In- Process Sample Stage.</th>
                                <th style="width: 10% pt-3">Packing Material Type</th>
                                <th style="width: 16% pt-2"> Stability for</th>
                                <th style="width: 16% pt-2"> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($info_product_materials && is_array($info_product_materials->data))
                            @foreach($info_product_materials->data as $info_product_material)
                                <tr>
                                    <td><input disabled type="text" name="info_product_material[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_product_code]" value="{{ $info_product_material['info_product_code'] ?? '' }}"></td>
                                    <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_batch_no]" value="{{ $info_product_material['info_batch_no'] ?? '' }}"></td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="text" id="info_mfg_date_{{ $loop->index }}" readonly placeholder="MM-YYYY" name="info_product_material[{{ $loop->index }}][info_mfg_date]"
                                                     value="{{ Helpers::getmonthFormat($info_product_material['info_mfg_date'] ?? '') }}"  />
                                                    <input  {{Helpers::isOOSChemical($data->stage)}} type="month" name="info_product_material[{{ $loop->index }}][info_mfg_date]" 
                                                    value="{{$info_product_material['info_mfg_date']}}" class="hide-input" oninput="handleMonthInput(this, 'info_mfg_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" id="info_expiry_date_{{ $loop->index }}" value="{{ Helpers::getmonthFormat($info_product_material['info_expiry_date'] ?? '') }}" readonly placeholder="MM-YYYY" />
                                                    <input  {{Helpers::isOOSChemical($data->stage)}} type="month" name="info_product_material[{{ $loop->index }}][info_expiry_date]" 
                                                    value="{{ $info_product_material['info_expiry_date'] ?? '' }}" class="hide-input" oninput="handleMonthInput(this, 'info_expiry_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_label_claim]" value="{{ $info_product_material['info_label_claim'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_pack_size]" value="{{ $info_product_material['info_pack_size'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_analyst_name]" value="{{ $info_product_material['info_analyst_name'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_others_specify]" value="{{ $info_product_material['info_others_specify'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_process_sample_stage]" value="{{ $info_product_material['info_process_sample_stage'] ?? '' }}"></td>
                                    <td>
                                    <select {{Helpers::isOOSChemical($data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_packing_material_type]" id="info_product_material">
                                        <option value="">--Select--</option>
                                        <option value="Primary" {{ $info_product_material['info_packing_material_type'] === 'Primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="Secondary" {{ $info_product_material['info_packing_material_type'] === 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="Tertiary" {{ $info_product_material['info_packing_material_type'] === 'Tertiary' ? 'selected' : '' }}>Tertiary</option>
                                        <option value="Not Applicable" {{ $info_product_material['info_packing_material_type'] === 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                                    </select>
                                   </td>
                                    <td>
                                        <select {{Helpers::isOOSChemical($data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_stability_for]" id="info_product_material">
                                            <option value="">--Select--</option>
                                            <option value="Submission" {{ $info_product_material['info_stability_for'] === 'Submission' ? 'selected' : '' }}>Submission</option>
                                            <option value="Commercial" {{ $info_product_material['info_stability_for'] === 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                            <option value="Pack Evaluation" {{ $info_product_material['info_stability_for'] === 'Pack Evaluation' ? 'selected' : '' }}>Pack Evaluation</option>
                                            <option value="Not Applicable" {{ $info_product_material['info_stability_for'] === 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                                        </select>
                                    </td>
                                    <td><button type="text" class="removeRowBtn">Remove</button></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody> 
                    </table>
                </div>
            </div>
            <!-- -------------------------------grid-2  ----------------------------------   -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Details of Stability Study
                    <button type="button" name="audit-agenda-grid" id="details_stability" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="details_stability_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%">AR Number</th>
                                <th style="width: 12%">Condition: Temperature & RH</th>
                                <th style="width: 12%">Interval</th>
                                <th style="width: 16%">Orientation</th>
                                <th style="width: 16%">Pack Details (if any)</th>
                                <th style="width: 16%">Specification No.</th>
                                <th style="width: 16%">Sample Description</th>
                                <th style="width: 4%"> Action </th>
                            </tr>
                        </thead>
                        @if($details_stabilities && is_array($details_stabilities->data))
                            @foreach ($details_stabilities->data as $details_stabilitie)
                                <tr>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} disabled type="text" name="details_stability[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_arnumber]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_arnumber') }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_condition_temprature_rh]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_condition_temprature_rh') }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_Interval]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_Interval') }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_orientation]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_orientation') }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_pack_details]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_pack_details') }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_specification_no]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_specification_no') }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_sample_description]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_sample_description') }}"></td> 
                                    <td><button type="text" class="removeRowBtn">Remove</button></td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
            <!----------------grid-3----------------------------------- -->

            <div class="group-input">
                <label for="audit-agenda-grid">
                    OOS Details
                    <button type="button" name="audit-agenda-grid" id="oos_details" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oos_details_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%">AR Number.</th>
                                <th style="width: 8%">Test Name of OOS</th>
                                <th style="width: 12%">Results Obtained</th>
                                <th style="width: 16%">Specification Limit</th>
                                <th style="width: 14%">File Attachment</th>
                                <th style="width: 16%">Submit On</th>
                                <th style="width: 8%">Submit By</th>
                                <th style="width: 5%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($oos_details && is_array($oos_details->data))
                                @foreach ($oos_details->data as $oos_detail)
                                    <tr>
                                        <td><input disabled type="text" name="oos_detail[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_arnumber]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_arnumber') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_test_name]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_test_name') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_results_obtained]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_results_obtained') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_specification_limit]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_specification_limit') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}}  type="file" name="oos_detail[{{ $loop->index }}][oos_file_attachment]"></td>
                                        <td>
                                          <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="text" id="oos_submit_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($oos_detail['oos_submit_on'] ?? '') }}" readonly placeholder="DD-MM-YYYY" />
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="date" name="oos_detail[{{ $loop->index }}][oos_submit_on]" 
                                                    value="{{ $oos_detail['oos_submit_on'] ?? '' }}"  class="hide-input" oninput="handleDateInput(this, 'oos_submit_on_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                          </div>
                                       </td>
                                       <td><input  {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_submit_by]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_submit_by') }}"></td>
                                       <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
             <!----------------grid-4 Products_details----------------------------------- -->

             <div class="group-input">
                <label for="audit-agenda-grid">
                    Product details
                    <button type="button" name="audit-agenda-grid" id="products_details" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="products_details_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%"> Name of Product</th>
                                <th style="width: 8%"> A.R.No </th>
                                <th style="width: 8%"> Sampled on </th>
                                <th style="width: 8%"> Sample by</th>
                                <th style="width: 8%"> Analyzed on</th>
                                <th style="width: 8%"> Observed on </th>
                                <th style="width: 5%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products_details && is_array($products_details->data))
                                @foreach ($products_details->data as $products_detail)
                                    <tr>
                                        <td><input disabled type="text" name="products_details[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="products_details[{{ $loop->index }}][product_name]" value="{{ Helpers::getArrayKey($products_detail, 'product_name') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="products_details[{{ $loop->index }}][product_AR_No]" value="{{ Helpers::getArrayKey($products_detail, 'product_AR_No') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="text" id="sampled_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['sampled_on'] ?? '') }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly placeholder="DD-MM-YYYY" />
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="date" name="products_details[{{ $loop->index }}][sampled_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ $products_detail['sampled_on'] ?? '' }}"  class="hide-input" oninput="handleDateInput(this, 'sampled_on_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="products_details[{{ $loop->index }}][sample_by]" value="{{ Helpers::getArrayKey($products_detail, 'sample_by') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="text" id="analyzed_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['analyzed_on'] ?? '') }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly placeholder="DD-MM-YYYY" />
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="date" name="products_details[{{ $loop->index }}][analyzed_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ $products_detail['analyzed_on'] ?? '' }}"  class="hide-input" oninput="handleDateInput(this, 'analyzed_on_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input type="text" id="observed_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['observed_on'] ?? '') }}"
                                                    max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"    readonly placeholder="DD-MM-YYYY" {{Helpers::isOOSChemical($data->stage)}} />
                                                    <input type="date" name="products_details[{{ $loop->index }}][observed_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                                    value="{{ $products_detail['observed_on'] ?? '' }}"  class="hide-input" 
                                                    oninput="handleDateInput(this, 'observed_on_{{ $loop->index }}')"   {{Helpers::isOOSChemical($data->stage)}} >
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!----------------grid-5 instrument_detail----------------------------------- -->

            <div class="group-input">
                <label for="audit-agenda-grid">
                    Instrument details
                    <button type="button" name="audit-agenda-grid" id="instrument_detail" {{ $data->stage == 1 ? '' : 'disabled' }}>+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="instrument_details_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%"> Name of instrument</th>
                                <th style="width: 8%"> Instrument Id Number</th>
                                <th style="width: 8%"> Calibrated On</th>
                                <th style="width: 8%"> Calibrated Due Date</th>
                                <th style="width: 5%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($instrument_detail && is_array($instrument_detail->data))
                                @foreach ($instrument_detail->data as $instrument_detail)
                                    <tr>
                                        <td><input disabled type="text" name="instrument_detail[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="instrument_detail[{{ $loop->index }}][instrument_name]" value="{{ Helpers::getArrayKey($instrument_detail, 'instrument_name') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="instrument_detail[{{ $loop->index }}][instrument_id_number]" value="{{ Helpers::getArrayKey($instrument_detail, 'instrument_id_number') }}"></td>
                                        <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="calibrated_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['calibrated_on'] ?? '') }}"
                                                         readonly placeholder="DD-MM-YYYY" {{Helpers::isOOSChemical($data->stage)}} />
                                                        <input type="date" name="instrument_detail[{{ $loop->index }}][calibrated_on]" 
                                                        value="{{ $products_detail['calibrated_on'] ?? '' }}"  class="hide-input" 
                                                        oninput="handleDateInput(this, 'calibrated_on_{{ $loop->index }}')"   {{Helpers::isOOSChemical($data->stage)}} >
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <div class="calenderauditee">
                                                            <input type="text" id="calibratedduedate_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['calibratedduedate_on'] ?? '') }}"
                                                             readonly placeholder="DD-MM-YYYY" {{Helpers::isOOSChemical($data->stage)}} />
                                                            <input type="date" name="instrument_detail[{{ $loop->index }}][calibratedduedate_on]" 
                                                            value="{{ $products_detail['calibratedduedate_on'] ?? '' }}"  class="hide-input" 
                                                            oninput="handleDateInput(this, 'calibratedduedate_on_{{ $loop->index }}')"   {{Helpers::isOOSChemical($data->stage)}} >
                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="button-block">
                @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)
                
                @else
                <button type="submit" class="saveButton">Save</button>
                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                @endif
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
            </div>
        </div>
    </div>
</div>
