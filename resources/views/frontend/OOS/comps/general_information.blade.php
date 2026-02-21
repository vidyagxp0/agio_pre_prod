@php
    $istab1 = $data->stage == 1 && (($data->initiator_id == Auth::user()->id) || (Helpers::check_roles($data->division_id, 'OOS/OOT', 3) || Helpers::check_roles($data->division_id, 'OOS/OOT', 18)));
@endphp
<div id="CCForm1" class="inner-block cctabcontent">
    <div class="inner-block-content">

        <div class="sub-head">General Information</div>
        <div class="row">
            <div class="col-lg-6 new-time-data-field">
                <div class="group-input input-time">
                    <label for="Initiator Group">Type</label>
                    <select disabled name="Form_type" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'disabled' }}>
                        <option value="">--Select---</option>
                        <option value="OOS_Chemical" {{ $data->Form_type == 'OOS_Chemical' ? 'selected' : '' }}>OOS Chemical</option>
                        <option value="OOS_Micro" {{ $data->Form_type == 'OOS_Micro' ? 'selected' : '' }}>OOS Micro</option>
                        <option value="OOT" {{ $data->Form_type == 'OOT' ? 'selected' : '' }}>OOT</option>
                    </select>
                </div>
                <input type="hidden" name="Form_type" value="{{ $data->Form_type }}">
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
                    <label disabled for="Short Description">Site/Location Code<span
                            class="text-danger"></span></label>
                    <input disabled type="text" name="division_code"
                        value="{{ Helpers::getDivisionName($data->division_id) }}">
                    <input type="hidden" name="division_id" value="{{ Helpers::getDivisionName($data->division_id) }}"

                    >
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Initiator <span class="text-danger"></span></label>
                    <input disabled type="text" name="initiator" value="{{ App\Models\User::find($data->initiator_id)?->name }}">
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
                        <input  type="text" name="due_date" id="due_date" readonly  value="{{ Helpers::getdateFormat($data->due_date) }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MMM-YYYY"/>
                        <input  type="date" name="due_date" value="{{ $data->due_date }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input" oninput="handleDateInput(this, 'due_date')" {{ $istab1 ? '' : 'readonly' }} />
                    </div>

                </div>
            </div>
            
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Short Description">Short Description
                        <span class="text-danger">*</span></label>
                        <span id="rchars">255</span>characters remaining
                        <input id="docname"  name="description_gi" maxlength="255" required {{Helpers::isOOSChemical($data->stage)}} value="{{ $data->description_gi }}" {{ $istab1 ? '' : 'readonly' }}>

                </div>
            </div>
            <p id="docnameError" style="color:red">**Short Description is required</p>

            
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator"><b>Initiator Department</b></label>
                    <input readonly type="text" name="initiator_group" id="initiator_group"
                        value="{{ $data->initiator_group }}">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiation Group Code">Initiation Department Code</label>
                    <input type="text" name="initiator_group_code"
                        value="{{ $data->initiator_group_code }}" id="initiator_group_code"
                        readonly>

                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">Is Repeat?<span class="text-danger">*</span></label>
                    <select name="is_repeat_gi" id="assignableSelect" {{ $istab1 ? 'required' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data->is_repeat_gi == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data->is_repeat_gi == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
                <!-- <input type="hidden" name="is_repeat_gi" value="{{ $data->is_repeat_gi }}"> -->
                @if ($istab1 && !Helpers::check_roles($data->division_id, 'OOS/OOT', 18) || $data->stage != 1)
                    <input type="hidden" value="{{$data->is_repeat_gi}}" name="is_repeat_gi">
                @endif
            </div>

            <div class="col-lg-6" id="rootCauseGroup" style="display: none;">
                <div class="group-input">
                    <label for="RootCause">Repeat Nature<span class="text-danger">*</span></label>
                    <textarea name="repeat_nature" id="rootCauseTextarea" rows="4" placeholder="Describe the Is Repeat here" {{ $istab1 ? '' : 'readonly' }}>{{ $data->repeat_nature }}</textarea>
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



            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Source Document Type  <span class="text-danger">*</span></label>
                    <select name="source_document_type_gi" id="Change_Application" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? 'required' : 'disabled' }}>
                        <option value="0">Enter Your Selection Here</option>
                        <option value="OOT" @if ($data->source_document_type_gi == 'OOT') selected @endif>OOT</option>
                        <option value="Lab Incident" @if ($data->source_document_type_gi == 'Lab Incident') selected @endif>Lab Incident</option>
                        <option value="Deviation" @if ($data->source_document_type_gi == 'Deviation') selected @endif>Deviation</option>
                        <option value="Product Non-conformance" @if ($data->source_document_type_gi == 'Product Non-conformance') selected @endif>Product Non-conformance</option>
                        <option value="Inspectional Observation" @if ($data->source_document_type_gi == 'Inspectional Observation') selected @endif>Inspectional Observation</option>
                        <option value="Others" @if ($data->source_document_type_gi == 'Others') selected @endif>Others</option>
                    </select>
                </div>
                    @if ($istab1 && !Helpers::check_roles($data->division_id, 'OOS/OOT', 18) || $data->stage != 1)
                        <input type="hidden" value="{{$data->source_document_type_gi}}" name="source_document_type_gi">
                    @endif
            </div>

            <div class="col-6 new-date-data-field" id="any-other-section" style="display: none;">
                <div class="group-input">
                    <label for="Other Application"> Other Source Document Type</label>
                    <input type="text" name="sourceDocOtherGi" id="other_application"
                        class="form-control" value="{{$data->sourceDocOtherGi}}">
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#Change_Application').on('change', function() {
                        var selectedValue = $(this).val(); // single select hai, array nahi

                        // Hide by default
                        $('#any-other-section').hide();
                        // $('#other_application').removeAttr('required');
                        $('#required-star').hide();

                        if (selectedValue === 'Others') {
                            $('#any-other-section').show();
                            // $('#other_application').attr('required', true);
                            $('#required-star').show();
                        }
                    });

                    // Trigger on page load for pre-filled data
                    $('#Change_Application').trigger('change');
                });
            </script>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference System Document <span class="text-danger">*</span></label>
                    <input type="text" name="reference_system_document_gi"  id="reference_system_document_gi"
                        value="{{ $data->reference_system_document_gi ?? '' }}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? 'required' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="reference_document">Reference Document  <span class="text-danger">*</span></label>
                    <input type="text" name="reference_document"  id="reference_document"
                        value="{{ $data->reference_document ?? '' }}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="oos Occurred On"> OOS/OOT Occurred On <span class="text-danger">*</span></label>
                    <div></div>
                    <div class="calenderauditee">
                        <input type="text" id="deviation_occured_on_gi" readonly value="{{ Helpers::getdateFormat($data->deviation_occured_on_gi ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY"/>
                        <input type="date" name="deviation_occured_on_gi" value="{{ $data->deviation_occured_on_gi }}" class="hide-input" oninput="handleDateInput(this, 'deviation_occured_on_gi')" {{ $istab1 ? 'required' : 'readonly' }} />
                    </div>
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Deviation Occurred On"> OOS/OOT Observed On <span class="text-danger">*</span></label>
                    <div></div>
                    <div class="calenderauditee">
                        <input type="text" id="oos_observed_on" readonly value="{{ Helpers::getdateFormat($data['oos_observed_on'] ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="oos_observed_on" value="{{ $data->oos_observed_on }}" class="hide-input" oninput="handleDateInput(this, 'oos_observed_on')" {{ $istab1 ? 'required' : 'readonly' }} />
                    </div>
                </div>
            </div>
            <div class="col-lg-12 new-time-data-field">
                {{-- @error('delay_justification') @else delayJustificationBlock @enderror --}}
                <div class="group-input input-time ">
                    <label for="deviation_time">Delay Justification <span class="text-danger">*</span></label>
                    <textarea id="delay_justification" name="delay_justification" {{ $istab1 ? 'required' : 'readonly' }}>{{ $data->delay_justification }}</textarea>
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
                    <label for="Deviation Occurred On"> OOS/OOT Reported On <span class="text-danger">*</span> </label>
                    <div class="calenderauditee">
                        <input type="text" id="oos_reported_date" readonly  value="{{ Helpers::getdateFormat($data['oos_reported_date'] ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="oos_reported_date" value="{{ $data->oos_reported_date }}" class="hide-input" oninput="handleDateInput(this, 'oos_reported_date')" {{ $istab1 ? 'required' : 'readonly' }}/>
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
                    <label for="Immediate action">Immediate Action <span class="text-danger">*</span></label>
                        <textarea name="immediate_action" id="immediate_action" {{ Helpers::isOOSChemical($data->stage) }} {{ $istab1 ? 'required' : 'readonly' }}>{{ $data->immediate_action ?? '' }}</textarea>
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
                            {{ $istab1 ? '' : 'disabled' }}  multiple     {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-head pt-3">OOS/OOT Information</div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Sample Type <span class="text-danger">*</span></label>
                    <select name="sample_type_gi" id="sample_other" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Raw Material"{{ $data->sample_type_gi == 'Raw Material' ?
                            'selected' : '' }}>Raw Material</option>
                        <option value="Packing Material"{{ $data->sample_type_gi == 'Packing Material' ?
                            'selected' : '' }}>Packing Material</option>
                        <option value="Finished Product"{{ $data->sample_type_gi == 'Finished Product' ?
                            'selected' : '' }}>Finished Product</option>
                        <option value="Stability Sample"{{ $data->sample_type_gi == 'Stability Sample' ?
                            'selected' : '' }}>Stability Sample</option>
                        <option value="Others"{{ $data->sample_type_gi == 'Others' ?
                            'selected' : '' }}>Others</option>
                    </select>
                </div>
                    @if ($data->stage != 1)
                        <input type="hidden" value="{{$data->sample_type_gi}}" name="sample_type_gi">
                    @endif
            </div>

            <div class="col-6 new-date-data-field" id="any-other1-section" style="display: none;">
                <div class="group-input">
                    <label for="Other Application"> Other Sample Type</label>
                    <input type="text" name="Others1" id="other1_application"
                        class="form-control" value="{{$data->Others1}}">
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    $('#sample_other').on('change', function() {
                        var selectedValue = $(this).val(); // single select hai, array nahi
                        // Hide by default
                        $('#any-other1-section').hide();
                        // $('#other_application').removeAttr('required');
                        $('#required-star').hide();

                        if (selectedValue === 'Others') {
                            $('#any-other1-section').show();
                            // $('#other_application').attr('required', true);
                            $('#required-star').show();
                        }
                    });

                    // Trigger on page load for pre-filled data
                    $('#sample_other').trigger('change');
                });
            </script>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Product / Material Name <span class="text-danger">*</span></label>
                    <input type="text" value="{{$data->product_material_name_gi}}"
                        name="product_material_name_gi" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Market<span class="text-danger">*</span></label>
                    <input type="text" name="market_gi" value="{{$data->market_gi}}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Customer<span class="text-danger">*</span></label>
                    <input type="text" name="customer_gi" value="{{$data->customer_gi}}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Specification Details<span class="text-danger">*</span></label>
                    <input type="text" name="specification_details" value="{{$data->specification_details}}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">STP Details<span class="text-danger">*</span></label>
                    <input type="text" name="STP_details" value="{{$data->STP_details}}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Manufacture/Vendor <span class="text-danger">*</span></label>
                    <input type="text" name="manufacture_vendor" value="{{$data->manufacture_vendor}}" {{Helpers::isOOSChemical($data->stage)}} {{ $istab1 ? '' : 'readonly' }}>
                </div>
            </div>

            <!-- ---------------------------grid-1 -------------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="info_product_material" {{ $istab1 ? 'required' : 'disabled' }}>+</button>
                    <span class="text-danger">*</span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="info_product_material_details"
                        style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 2%">Sr.No.</th>
                                <th style="width: 6%">Item/Product Code</th>
                                <th style="width: 8%">Batch No.</th>
                                <th style="width: 18%">Mfg.Date</th>
                                <th style="width: 18%">Expiry Date</th>
                                <th style="width: 8%">Label Claim.</th>
                                <th style="width: 8%">Pack Size</th>
                                <th style="width: 8%">Analyst Name</th>
                                <th style="width: 10%">Others (Specify)</th>
                                <th style="width: 10%">In- Process Sample Stage.</th>
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
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_product_code]" value="{{ $info_product_material['info_product_code'] ?? '' }}"{{ $istab1 ? 'required' : 'readonly' }} ></td>
                                    <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_batch_no]" value="{{ $info_product_material['info_batch_no'] ?? '' }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">

                                                <div class="calenderauditee">
                                                    <input {{Helpers::isOOSChemical($data->stage)}} type="text" id="info_mfg_date_{{ $loop->index }}" readonly placeholder="MM-YYYY" name="info_product_material[{{ $loop->index }}][info_mfg_date]"
                                                    value="{{ Helpers::getmonthFormat($info_product_material['info_mfg_date'] ?? '') }}" />
                                                    <input {{Helpers::isOOSChemical($data->stage)}} type="month" name="info_product_material[{{ $loop->index }}][info_mfg_date]"
                                                    value="{{ $info_product_material['info_mfg_date'] }}" class="hide-input"
                                                    oninput="handleMonthInput(this, 'info_mfg_date_{{ $loop->index }}')"> <!-- Use PHP's date function to get the current month -->
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
                                                    value="{{ $info_product_material['info_expiry_date'] ?? '' }}" class="hide-input"
                                                    oninput="handleMonthInput(this, 'info_expiry_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_label_claim]" value="{{ $info_product_material['info_label_claim'] ?? '' }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_pack_size]" value="{{ $info_product_material['info_pack_size'] ?? '' }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_analyst_name]" value="{{ $info_product_material['info_analyst_name'] ?? '' }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_others_specify]" value="{{ $info_product_material['info_others_specify'] ?? '' }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_process_sample_stage]" value="{{ $info_product_material['info_process_sample_stage'] ?? '' }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td>
                                    <select {{Helpers::isOOSChemical($data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_packing_material_type]" id="info_product_material" {{ $istab1 ? 'required' : 'readonly' }}>
                                        <option value="">--Select--</option>
                                        <option value="Primary" {{ $info_product_material['info_packing_material_type'] === 'Primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="Secondary" {{ $info_product_material['info_packing_material_type'] === 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="Tertiary" {{ $info_product_material['info_packing_material_type'] === 'Tertiary' ? 'selected' : '' }}>Tertiary</option>
                                        <option value="Not Applicable" {{ $info_product_material['info_packing_material_type'] === 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                                    </select>
                                   </td>
                                    <td>
                                        <select {{Helpers::isOOSChemical($data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_stability_for]" id="info_product_material" {{ $istab1 ? '' : 'readonly' }}>
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
                    <button type="button" name="audit-agenda-grid" id="details_stability" {{ $istab1 ? '' : 'disabled' }}>+</button>
                    <span class="text-danger">*</span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="details_stability_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Sr.No.</th>
                                <th style="width: 8%">AR Number</th>
                                <th style="width: 12%">Condition: Temperature & RH</th>
                                <th style="width: 12%">Interval</th>
                                <th style="width: 16%">Orientation</th>
                                <th style="width: 16%">Pack Details (if Any)</th>
                                <th style="width: 16%">Specification No.</th>
                                <th style="width: 16%">Sample Description</th>
                                <th style="width: 4%"> Action </th>
                            </tr>
                        </thead>
                        @if($details_stabilities && is_array($details_stabilities->data))
                            @foreach ($details_stabilities->data as $details_stabilitie)
                                <tr>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} disabled type="text" name="details_stability[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_arnumber]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_arnumber') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_condition_temprature_rh]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_condition_temprature_rh') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_Interval]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_Interval') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_orientation]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_orientation') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_pack_details]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_pack_details') }}" {{ $istab1 ? '' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_specification_no]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_specification_no') }}" {{ $istab1 ? '' : 'readonly' }}></td>
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_sample_description]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_sample_description') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
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
                    OOS/OOT Details
                    <button type="button" name="audit-agenda-grid" id="oos_details" {{ $istab1 ? '' : 'disabled' }}>+</button>
                    <span class="text-danger">*</span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oos_details_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Sr.No.</th>
                                <th style="width: 8%">AR Number.</th>
                                <th style="width: 8%">Test Name of OOS/OOT</th>
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
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_arnumber]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_arnumber') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_test_name]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_test_name') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_results_obtained]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_results_obtained') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_specification_limit]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_specification_limit') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                      

                                        <td>
                  

                                        @if(!empty($oos_detail['oos_file_attachment']))
                                            <a href="{{ asset('upload/'.$oos_detail['oos_file_attachment']) }}"
                                            target="_blank"
                                            class="btn btn-sm btn-primary mb-1">
                                                <i class="fa fa-eye"></i> View File
                                            </a>
                                        @endif


                                            <input {{Helpers::isOOSChemical($data->stage)}}
                                                type="file"
                                                name="oos_detail[{{ $loop->index }}][oos_file_attachment]"
                                                onchange="showFileName(this, {{ $loop->index }})">

                                            <span id="file-name-{{ $loop->index }}"></span>
                                        </td>
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
                                       <td><input  {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_submit_by]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_submit_by') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                       <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                function showFileName(input, index) {
                    // Check if file is selected
                    if (input.files && input.files[0]) {
                        // Get file name
                        var fileName = input.files[0].name;

                        // Show file name in the corresponding span
                        document.getElementById('file-name-' + index).innerText = fileName;
                    }
                }
            </script>

             <!----------------grid-4 Products_details----------------------------------- -->

            <div class="group-input">
                <label for="audit-agenda-grid">
                    Product Details
                    <button type="button" name="audit-agenda-grid" id="products_details" {{$istab1 ? '' : 'disabled' }}>+</button>
                    <span class="text-danger">*</span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="products_details_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Sr.No.</th>
                                <th style="width: 8%"> Name of Product</th>
                                <th style="width: 8%"> A.R.No </th>
                                <th style="width: 8%"> Sampled On </th>
                                <th style="width: 8%"> Sample By</th>
                                <th style="width: 8%"> Analyzed On</th>
                                <th style="width: 8%"> Observed On </th>
                                <th style="width: 5%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products_details && is_array($products_details->data))
                                @foreach ($products_details->data as $products_detail)
                                    <tr>
                                        <td><input disabled type="text" name="products_details[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="products_details[{{ $loop->index }}][product_name]" value="{{ Helpers::getArrayKey($products_detail, 'product_name') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="products_details[{{ $loop->index }}][product_AR_No]" value="{{ Helpers::getArrayKey($products_detail, 'product_AR_No') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
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
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="products_details[{{ $loop->index }}][sample_by]" value="{{ Helpers::getArrayKey($products_detail, 'sample_by') }}" {{ $istab1 ? '' : 'readonly' }}></td>
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
                    Instrument Details
                    <button type="button" name="audit-agenda-grid" id="instrument_detail" {{ $istab1 ? '' : 'disabled' }}>+</button>
                    <span class="text-danger">*</span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="instrument_details_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Sr.No.</th>
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
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="instrument_detail[{{ $loop->index }}][instrument_name]" value="{{ Helpers::getArrayKey($instrument_detail, 'instrument_name') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="instrument_detail[{{ $loop->index }}][instrument_id_number]" value="{{ Helpers::getArrayKey($instrument_detail, 'instrument_id_number') }}" {{ $istab1 ? 'required' : 'readonly' }}></td>
                                        <td>
                                            <div class="col-lg-6 new-date-data-field">
                                                <div class="group-input input-date">
                                                    <div class="calenderauditee">
                                                        <input type="text" id="calibrated_on_{{ $loop->index }}" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getdateFormat($instrument_detail['calibrated_on'] ?? '') }}"
                                                         readonly placeholder="DD-MM-YYYY" {{Helpers::isOOSChemical($data->stage)}} />
                                                        <input type="date" name="instrument_detail[{{ $loop->index }}][calibrated_on]" max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ $instrument_detail['calibrated_on'] ?? '' }}"  class="hide-input"
                                                        oninput="handleDateInput(this, 'calibrated_on_{{ $loop->index }}')"   {{Helpers::isOOSChemical($data->stage)}} >
                                                    </div>
                                                </div>
                                            </div>
                                            </td>
                                            <td>
                                                <div class="col-lg-6 new-date-data-field">
                                                    <div class="group-input input-date">
                                                        <div class="calenderauditee">
                                                            @php
                                                                $today = \Carbon\Carbon::now()->format('Y-m-d');
                                                                $oldDate = $instrument_detail['calibratedduedate_on'] ?? '';
                                                            @endphp
                                                            <input type="text" id="calibratedduedate_on_{{ $loop->index }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ Helpers::getdateFormat($instrument_detail['calibratedduedate_on'] ?? '') }}"
                                                             readonly placeholder="DD-MM-YYYY" {{Helpers::isOOSChemical($data->stage)}} />
                                                            {{-- <input type="date" name="instrument_detail[{{ $loop->index }}][calibratedduedate_on]" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  value="{{ $instrument_detail['calibratedduedate_on'] ?? '' }}"  class="hide-input"
                                                            oninput="handleDateInput(this, 'calibratedduedate_on_{{ $loop->index }}')"   {{Helpers::isOOSChemical($data->stage)}} > --}}

                                                            <input type="date" name="instrument_detail[{{ $loop->index }}][calibratedduedate_on]" value="{{ $oldDate }}" class="hide-input" oninput="handleDateInput(this, 'calibratedduedate_on_{{ $loop->index }}')" @if(empty($oldDate)) min="{{ $today }}" @endif>
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


  <!-- ------------------------------grid-5 instrument_detail-------------------------script -->
<script>
    $(document).ready(function() {
        $('#instrument_detail').click(function(e) {
            function generateTableRow(serialNumber) {
                var currentDate = new Date().toISOString().split('T')[0];

                var html =
                    '<tr>' +
                        '<td><input disabled type="text" name="instrument_detail['+ serialNumber +'][serial]" value="' + serialNumber +
                        '"></td>' +
                        '<td><input type="text" name="instrument_detail['+ serialNumber +'][instrument_name]"></td>'+
                        '<td><input type="text" name="instrument_detail['+ serialNumber +'][instrument_id_number]"></td>' +
                        '<td>' +
                            '<div class="col-lg-6 new-date-data-field">' +
                            '<div class="group-input input-date">' +
                            '<div class="calenderauditee">' +
                            '<input type="text" readonly id="calibrated_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                            '<input type="date" name="instrument_detail[' + serialNumber + '][calibrated_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibrated_on' + serialNumber + '\')" max="' + currentDate + '">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td>' +
                            '<div class="col-lg-6 new-date-data-field">' +
                            '<div class="group-input input-date">' +
                            '<div class="calenderauditee">' +
                            '<input type="text" readonly id="calibratedduedate_on' + serialNumber + '" placeholder="DD-MM-YYYY" />' +
                            '<input type="date" name="instrument_detail[' + serialNumber + '][calibratedduedate_on]" value="" class="hide-input" oninput="handleDateInput(this, \'calibratedduedate_on' + serialNumber + '\')" min="' + currentDate + '">' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                        '</td>' +
                        '<td><button type="text" class="removeRowBtn">Remove</button></td>' +

                    '</tr>';
                return html;
            }

            var tableBody = $('#instrument_details_details tbody');
            var rowCount = tableBody.children('tr').length;
            var newRow = generateTableRow(rowCount + 1);
            tableBody.append(newRow);
        });
    });
</script>
