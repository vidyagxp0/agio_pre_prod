<div id="CCForm1" class="inner-block cctabcontent">
        <div class="inner-block-content"><div class="sub-head">General Information</div>
        <div class="row">
        <div class="col-lg-6">
            <div class="group-input">
                <label for="Initiator Group">Type </label>
                <select disabled id="dynamicSelectType" name="type" {{Helpers::isOOSMicro($micro_data->stage)}}>
                    <option value="{{ route('oos_micro.index') }}">OOS Micro</option>
                    <option value="{{ route('oos.index') }}">OOS Chemical</option>
                    <option value="{{ route('oot.index')  }}">OOT</option>
                </select>
            </div>
        </div>
        <script>
            document.getElementById("dynamicSelectType").addEventListener("change", function() {
                var selectedRoute = this.value;
                window.location.href = selectedRoute; // Redirect to the selected route
            });
        </script>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator"> Record Number </label>
                    <input type="hidden" name="record" value="{{ $record_number }}">
                        <input disabled type="text" name="record"
                        value="{{ Helpers::getDivisionName($micro_data->division_id) }}/OOS Micro/{{ Helpers::year($micro_data->created_at) }}/{{ $micro_data->record ? str_pad($micro_data->record, 4, "0", STR_PAD_LEFT ) : '1' }}">
                </div>
            </div>
            <div class="col-lg-6">
               <div class="group-input">
                <label disabled for="Short Description">Division Code<span class="text-danger"></span></label>
                <input disabled type="text" name="division_code" value="{{ Helpers::getDivisionName($micro_data->division_id) }}">
                <input type="hidden" name="division_id" value="{{ session()->get('division') }}">
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Initiator <span class="text-danger"></span></label>
                    <input disabled type="text" name="initiator" value="{{ Auth::user()->name }}">
                </div>
            </div>
            @php
            $initiationDate = date('Y-m-d');
            $dueDate = date('Y-m-d', strtotime($initiationDate . '+30 days'));
        @endphp
            <div class="col-md-6 ">
                <div class="group-input ">
                    <label for="due-date"> Date Of Initiation <span class="text-danger"></span></label>
                    <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                    <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                </div>
            </div>
           

        <div class="col-md-6 new-date-data-field">
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
        </div>
        <script>
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
        </script>
            {{-- <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Date Due"> Due Date </label>
                    <div><small class="text-primary">If revising Due Date, kindly mention revision
                            reason in "Due Date Extension Justification" data field.</small></div>
                    <div class="calenderauditee">
                        <input type="text" id="due_date" readonly value="{{ Helpers::getdateFormat($micro_data['due_date'] ?? '') }}" placeholder="DD-MM-YYYY" />
                        <input type="date" name="due_date"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  {{Helpers::isOOSMicro($micro_data->stage)}}  class="hide-input"
                            oninput="handleDateInput(this, 'due_date')" />
                    </div>
                </div>
            </div>  --}}
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Short Description">Short Description
                        <span class="text-danger">*</span></label>
                        <span id="rchars">255</span>characters remaining
                        <input type="text" name="description_gi" id="docname" class="mic-input" maxlength="255" required  value="{{ $micro_data->description_gi }}">
                    {{-- <textarea id="docname"  name="description_gi" maxlength="255" required  {{Helpers::isOOSMicro($micro_data->stage)}} >{{ $micro_data->description_gi }}</textarea> --}}
                </div>
            </div>
            <p id="docnameError" style="color:red">**Short Description is required</p>                                                                                 
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group"><b>Initiation Department </b></label>
                    <select name="initiator_group_gi" id="initiator_group" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option selected disabled>---select---</option>
                        @foreach (Helpers::getInitiatorGroups() as $code => $initiator_group)
                        <option value="{{ $code }}" @if ($micro_data->initiator_group_gi == $code) selected
                            @endif>{{ $initiator_group }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">Initiation Department Group Code </label>
                    <input type="text" name="initiator_group_code_gi" id="initiator_group_code"
                        value="{{ $micro_data->initiator_group_code_gi }}" readonly {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
            {{-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Initiated Through ?</label>
                    <select name="initiated_through_gi" onchange="otherController(this.value, 'others', 'initiated_through_req')" {{Helpers::isOOSMicro($micro_data->stage)}}>
                            <option value="">Enter Your Selection Here</option>
                            <option value="internal_audit" @if ($micro_data->initiated_through_gi == 'internal_audit') selected @endif>Internal Audit</option>
                            <option value="external_audit" @if ($micro_data->initiated_through_gi == 'external_audit') selected @endif>External Audit</option>
                            <option value="recall" @if ($micro_data->initiated_through_gi == 'recall') selected @endif>Recall</option>
                            <option value="return" @if ($micro_data->initiated_through_gi == 'return') selected @endif>Return</option>
                            <option value="deviation" @if ($micro_data->initiated_through_gi == 'deviation') selected @endif>Deviation</option>
                            <option value="complaint" @if ($micro_data->initiated_through_gi == 'complaint') selected @endif>Complaint</option>
                            <option value="regulatory" @if ($micro_data->initiated_through_gi == 'regulatory') selected @endif>Regulatory</option>
                            <option value="lab-incident" @if ($micro_data->initiated_through_gi == 'lab-incident') selected @endif>Lab Incident</option>
                            <option value="improvement" @if ($micro_data->initiated_through_gi == 'improvement') selected @endif>Improvement</option>
                            <option value="others" @if ($micro_data->initiated_through_gi == 'others') selected @endif>Others</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Initiator Group Code">If Others </label>
                    <textarea name="if_others_gi" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->if_others_gi }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Is Repeat ?</label>
                    <select name="is_repeat_gi" onchange="otherController(this.value, 'Yes', 'repeat_nature')" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" @if ($micro_data->is_repeat_gi == 'Yes') selected @endif>Yes</option>
                        <option value="No" @if ($micro_data->is_repeat_gi == 'No') selected @endif>No</option>
                        <option value="NA" @if ($micro_data->is_repeat_gi == 'NA') selected @endif>NA</option>
                    </select>
                </div>
            </div>
            {{-- <div class="col-lg-6 mt-4">
                <div class="group-input">
                    <label for="Initiator Group">Repeat Nature</label>
                    <textarea name="repeat_nature_gi" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->repeat_nature_gi }}</textarea>
                </div>
            </div>
           <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Nature of Change</label>
                    <select name="nature_of_change_gi" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option>Enter Your Selection Here</option>
                        <option value="temporary" {{ $micro_data->nature_of_change_gi == 'temporary' ?
                            'selected' : '' }}>temporary</option>
                        <option value="permanent" {{ $micro_data->nature_of_change_gi == 'permanent' ?
                            'selected' : '' }}>permanent</option>
                    </select>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Source Document Type</label>
                    <select name="source_document_type_gi" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option>Enter Your Selection Here</option>
                        <option value="oot" @if ($micro_data->source_document_type_gi == 'oot') selected @endif>OOT</option>
                        <option value="lab-incident" @if ($micro_data->source_document_type_gi == 'lab-incident') selected @endif>Lab Incident</option>
                        <option value="deviation" @if ($micro_data->source_document_type_gi == 'deviation') selected @endif>Deviation</option>
                        <option value="product-non-conformance" @if ($micro_data->source_document_type_gi == 'product-non-conformance') selected @endif>Product Non-conformance</option>
                        <option value="inspectional-observation" @if ($micro_data->source_document_type_gi == 'inspectional-observation') selected @endif>Inspectional Observation</option>
                        <option value="other" @if ($micro_data->source_document_type_gi == 'other') selected @endif>Others</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference System Document</label>
                    <input type="text" name="reference_system_document_gi" value="{{ $micro_data->reference_system_document_gi}}" {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference Document</label>
                   <input type="text" name="reference_document_gi" value="{{ $micro_data->reference_document_gi}}" {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Deviation Occurred On">OOS occurred On </label>
                    <div class="calenderauditee">
                        <input type="text" id="deviation_occured_on_gi" readonly value="{{ Helpers::getdateFormat($micro_data['deviation_occured_on_gi'] ?? '') }}" placeholder="DD-MM-YYYY" />
                        <input type="date" name="deviation_occured_on_gi" class="hide-input"
                            oninput="handleDateInput(this, 'deviation_occured_on_gi')"  {{Helpers::isOOSMicro($micro_data->stage)}}/>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Deviation Occurred On"> OOS Observed On </label>
                    <div><small class="text-primary"></small></div>
                    <div class="calenderauditee">
                        <input type="text" id="oos_observed_on" readonly 
                        value="{{ Helpers::getdateFormat($micro_data['oos_observed_on'] ?? '') }}" {{Helpers::isOOSChemical($micro_data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="oos_observed_on" class="hide-input" oninput="handleDateInput(this, 'oos_observed_on')" />
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 new-time-data-field">
                {{-- @error('delay_justification') @else delayJustificationBlock @enderror --}}
                <div class="group-input input-time ">
                    <label for="deviation_time">Delay Justification <span class="text-danger">*</span></label>
                    <textarea id="delay_justification" name="delay_justification">{{ $micro_data->delay_justification }}</textarea>
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
                    <label for="Deviation Occurred On"> OOS Reported On</label>
                    <div><small class="text-primary"></small></div>
                    <div class="calenderauditee">
                        <input type="text" id="oos_reported_date" readonly 
                        value="{{ Helpers::getdateFormat($micro_data['oos_reported_date'] ?? '') }}" {{Helpers::isOOSChemical($micro_data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="oos_reported_date" class="hide-input" oninput="handleDateInput(this, 'oos_reported_date')" />
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


            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Immediate action">Immediate action</label>
                    <input type="text" name="immediate_action"  id="immediate_action" 
                        value="{{ $micro_data->immediate_action ?? '' }}" {{Helpers::isOOSChemical($micro_data->stage)}}>
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

                        @if ($micro_data->initial_attachment_gi)
                        @foreach ($micro_data->initial_attachment_gi as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}"
                                    target="_blank"><i class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                 class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                            </h6>
                        @endforeach
                        @endif
                            {{--@if(!empty($micro_data->initial_attachment_gi))
                                @foreach($micro_data->initial_attachment_gi as $file)
                                    <div>{{ $file }}</div>
                                @endforeach
                            @endif--}}
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="initial_attachment_gi[]" 
                            oninput="addMultipleFiles(this, 'initial_attachment_gi')" multiple {{Helpers::isOOSMicro($micro_data->stage)}}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-head pt-3">OOS Information</div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Sample Type">Sample Type</label>
                    <select name="sample_type_gi" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="raw-material" @if ($micro_data->sample_type_gi == 'raw-material') selected @endif>Raw Material</option>
                        <option value="packing-material" @if ($micro_data->sample_type_gi == 'packing-material') selected @endif>Packing Material</option>
                        <option value="finished-product" @if ($micro_data->sample_type_gi == 'finished-product') selected @endif>Finished Product</option>
                        <option value="stability-sample" @if ($micro_data->sample_type_gi == 'stability-sample') selected @endif>Stability Sample</option>
                        <option value="other" @if ($micro_data->sample_type_gi == 'other') selected @endif>Others</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description ">Product / Material Name</label>
                    <input type="text" name="product_material_name_gi" value="{{ $micro_data->product_material_name_gi }}" {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Market ">Market</label>
                    <input type="text" name="market_gi" value="{{ $micro_data->market_gi }}" {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Customer ">Customer*</label>
                   <input type="text" name="customer_gi" value="{{ $micro_data->customer_gi}}" {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
             <!-- ---------------------------grid-1 -------------------------------- -->
             <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="info_product_material">+</button>
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
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_product_code]" value="{{ $info_product_material['info_product_code'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_batch_no]" value="{{ $info_product_material['info_batch_no'] ?? '' }}"></td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input type="text" id="info_mfg_date_{{ $loop->index }}" readonly placeholder="MM-YYYY" name="info_product_material[{{ $loop->index }}][info_mfg_date]"
                                                     value="{{ Helpers::getmonthFormat($info_product_material['info_mfg_date'] ?? '') }}"  />
                                                    <input {{Helpers::isOOSMicro($micro_data->stage)}} type="month" name="info_product_material[{{ $loop->index }}][info_mfg_date]" 
                                                    value="{{$info_product_material['info_mfg_date']}}" class="hide-input" oninput="handleMonthInput(this, 'info_mfg_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input type="text" id="info_expiry_date_{{ $loop->index }}" value="{{ Helpers::getmonthFormat($info_product_material['info_expiry_date'] ?? '') }}" readonly placeholder="MM-YYYY" />
                                                    <input type="month" name="info_product_material[{{ $loop->index }}][info_expiry_date]" 
                                                    value="{{ $info_product_material['info_expiry_date'] ?? '' }}" class="hide-input" oninput="handleMonthInput(this, 'info_expiry_date_{{ $loop->index }}')"  {{Helpers::isOOSMicro($micro_data->stage)}}>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_label_claim]" value="{{ $info_product_material['info_label_claim'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_pack_size]" value="{{ $info_product_material['info_pack_size'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_analyst_name]" value="{{ $info_product_material['info_analyst_name'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_others_specify]" value="{{ $info_product_material['info_others_specify'] ?? '' }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_process_sample_stage]" value="{{ $info_product_material['info_process_sample_stage'] ?? '' }}"></td>
                                    <td>
                                    <select {{Helpers::isOOSMicro($micro_data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_packing_material_type]" id="facility_name">
                                        <option value="">--Select--</option>
                                        <option value="Primary" {{ $info_product_material['info_packing_material_type'] === 'Primary' ? 'selected' : '' }}>Primary</option>
                                        <option value="Secondary" {{ $info_product_material['info_packing_material_type'] === 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                        <option value="Tertiary" {{ $info_product_material['info_packing_material_type'] === 'Tertiary' ? 'selected' : '' }}>Tertiary</option>
                                        <option value="Not Applicable" {{ $info_product_material['info_packing_material_type'] === 'Not Applicable' ? 'selected' : '' }}>Not Applicable</option>
                                    </select>
                                   </td>
                                    <td>
                                        <select {{Helpers::isOOSMicro($micro_data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_stability_for]" id="info_product_material">
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
                    <button type="button" name="audit-agenda-grid" id="details_stability">+</button>
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
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} disabled type="text" name="details_stability[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_arnumber]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_arnumber') }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_condition_temprature_rh]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_condition_temprature_rh') }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_Interval]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_Interval') }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_orientation]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_orientation') }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_pack_details]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_pack_details') }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_specification_no]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_specification_no') }}"></td>
                                    <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="details_stability[{{ $loop->index }}][stability_study_sample_description]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_sample_description') }}"></td> 
                                    <td><button  {{Helpers::isOOSMicro($micro_data->stage)}} type="text" class="removeRowBtn">Remove</button></td>
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
                    <button type="button" name="audit-agenda-grid" id="oos_details">+</button>
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
                                <th style="width: 5%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($oos_details && is_array($oos_details->data))
                                @foreach ($oos_details->data as $oos_detail)
                                    <tr>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} disabled type="text" name="oos_detail[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_arnumber]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_arnumber') }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_test_name]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_test_name') }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_results_obtained]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_results_obtained') }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="oos_detail[{{ $loop->index }}][oos_specification_limit]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_specification_limit') }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="file" name="oos_detail[{{ $loop->index }}][oos_file_attachment]"></td>
                                        <td>
                                          <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input type="text" id="oos_submit_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($oos_detail['oos_submit_on'] ?? '') }}" readonly placeholder="DD-MM-YYYY" />
                                                    <input {{Helpers::isOOSMicro($micro_data->stage)}} type="date" name="oos_detail[{{ $loop->index }}][oos_submit_on]" 
                                                    value="{{ $oos_detail['oos_submit_on'] ?? '' }}"  class="hide-input" oninput="handleDateInput(this, 'oos_submit_on_{{ $loop->index }}')">
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
             <!----------------grid-4 Products_details----------------------------------- -->

             <div class="group-input">
                <label for="audit-agenda-grid">
                    Product details
                    <button type="button" name="audit-agenda-grid" id="products_details">+</button>
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
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="products_details[{{ $loop->index }}][product_name]" value="{{ Helpers::getArrayKey($products_detail, 'product_name') }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="products_details[{{ $loop->index }}][product_AR_No]" value="{{ Helpers::getArrayKey($products_detail, 'product_AR_No') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSMicro($micro_data->stage)}}  type="text" id="sampled_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['sampled_on'] ?? '') }}" readonly placeholder="DD-MM-YYYY" />
                                                    <input  {{Helpers::isOOSMicro($micro_data->stage)}}  type="date" name="products_details[{{ $loop->index }}][sampled_on]" 
                                                    value="{{ $products_detail['sampled_on'] ?? '' }}"  class="hide-input" oninput="handleDateInput(this, 'sampled_on_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="products_details[{{ $loop->index }}][sample_by]" value="{{ Helpers::getArrayKey($products_detail, 'sample_by') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSMicro($micro_data->stage)}}  type="text" id="analyzed_on_{{ $loop->index }}" value="{{ Helpers::getdateFormat($products_detail['analyzed_on'] ?? '') }}" readonly placeholder="DD-MM-YYYY" />
                                                    <input  {{Helpers::isOOSMicro($micro_data->stage)}}  type="date" name="products_details[{{ $loop->index }}][analyzed_on]" 
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
                                                     readonly placeholder="DD-MM-YYYY" {{Helpers::isOOSMicro($micro_data->stage)}} />
                                                    <input type="date" name="products_details[{{ $loop->index }}][observed_on]" 
                                                    value="{{ $products_detail['observed_on'] ?? '' }}"  class="hide-input" 
                                                    oninput="handleDateInput(this, 'observed_on_{{ $loop->index }}')"   {{Helpers::isOOSMicro($micro_data->stage)}} >
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
            <!----------------grid-5 instrument_details----------------------------------- -->

            <div class="group-input">
                <label for="audit-agenda-grid">
                    Instrument details
                    <button type="button" name="audit-agenda-grid" id="instrument_details">+</button>
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
                                <th style="width: 5%"> Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($instrument_details && is_array($instrument_details->data))
                                @foreach ($instrument_details->data as $instrument_detail)
                                    <tr>
                                        <td><input disabled type="text" name="instrument_detail[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="instrument_detail[{{ $loop->index }}][instrument_name]" value="{{ Helpers::getArrayKey($instrument_detail, 'instrument_name') }}"></td>
                                        <td><input {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="instrument_detail[{{ $loop->index }}][instrument_id_number]" value="{{ Helpers::getArrayKey($instrument_detail, 'instrument_id_number') }}"></td>
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            
           <!-- close grid -->
            <div class="button-block">
            @if ($micro_data->stage == 0  || $micro_data->stage >= 14)
            <div class="progress-bars">
                    <div class="bg-danger">Workflow is already Closed-Done</div>
                </div>
            @else
                <button type="submit" class="saveButton">Save</button>
                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
            @endif
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >
                        Exit </a> </button>
            </div>
        </div>
    </div>
</div>