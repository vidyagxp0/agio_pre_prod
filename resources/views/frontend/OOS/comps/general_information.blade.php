<div id="CCForm1" class="inner-block cctabcontent">
    <div class="inner-block-content">

        <div class="sub-head">General Information</div>
        <div class="row">
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Type </label>
                    <select id="dynamicSelectType" name="type" {{Helpers::isOOSChemical($data->stage)}}>
                        <option value="{{ route('oos.index') }}">OOS Chemical</option>
                        <option value="{{ route('oos_micro.index') }}">OOS Micro</option>
                        <option value="{{ route('oot.index');  }}">OOT</option>
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
                     <input disabled type="text" name="record_number"
                      value="{{ Helpers::getDivisionName($data->division_id) }}/OOS Chemical/{{ Helpers::year($data->created_at) }}/{{ $data->record_number ? str_pad($data->record_number, 4, "0", STR_PAD_LEFT ) : '1' }}">
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
                    <div><small class="text-primary">If revising Due Date, kindly mention revision
                            reason in "Due Date Extension Justification" data field.</small></div>
                    <div class="calenderauditee">
                        <input type="text" id="due_date" readonly value="{{ Helpers::getdateFormat($data['due_date'] ?? '') }}" placeholder="DD-MM-YYYY" {{Helpers::isOOSChemical($data->stage)}}/>
                        <input type="date" name="due_date"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                            oninput="handleDateInput(this, 'due_date')" />
                    </div>
                    
                </div>
            </div>
                                                                                              
            {{-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description"> Severity Level</label>
                    <select name="severity_level_gi"  {{Helpers::isOOSChemical($data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Major" {{ $data->severity_level_gi == 'Major' ? 'selected' :
                            '' }}>Major</option>
                        <option value="Minor" {{ $data->severity_level_gi == 'Minor' ? 'selected' :
                            '' }}>Minor</option>
                        <option value="Critical" {{ $data->severity_level_gi == 'Critical' ? 'selected' :
                        '' }}>Critical</option>
                    </select>
                </div>
            </div> --}}
            
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Short Description">Short Description
                        <span class="text-danger">*</span></label>
                        <span id="rchars">255</span>characters remaining
                        <textarea id="docname"  name="description_gi" maxlength="255" required {{Helpers::isOOSChemical($data->stage)}}>
                            {{ $data->description_gi }}</textarea>
                </div>
            </div>
            <p id="docnameError" style="color:red">**Short Description is required</p>
                        
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description"> Initiation department Group <span
                            class="text-danger"></span></label>
                    <select name="initiator_group" id="initiator_group"  {{Helpers::isOOSChemical($data->stage)}}>
                        <option selected disabled>---select---</option>
                        @foreach (Helpers::getInitiatorGroups() as $code => $initiator_group)
                        <option value="{{ $code }}" @if ($data->initiator_group == $code) selected
                            @endif>{{ $initiator_group }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Initiation department Code <span
                            class="text-danger"></span></label>
                    <input type="text" name="initiator_group_code"  id="initiator_group_code" readonly
                        value="{{ $data->initiator_group_code ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">If Others</label>
                    <textarea type="if_others_gi" name="if_others_gi" {{Helpers::isOOSChemical($data->stage)}}>{{ $data->if_others_gi }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">Is Repeat?</label>
                        <select name="is_repeat_gi" {{Helpers::isOOSChemical($data->stage)}}>
                        <option value="" >Enter Your Selection Here</option>
                        <option value="yes" {{ $data->is_repeat_gi == 'yes' ? 'selected' : '' }}>yes</option>
                        <option value="No" {{ $data->is_repeat_gi == '2' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 mt-4">
                <div class="group-input">
                    <label for="Initiator Group">Repeat Nature</label>
                    <textarea type="text" name="repeat_nature_gi" {{Helpers::isOOSChemical($data->stage)}}>{{ $data->repeat_nature_gi }}</textarea>
                </div>
            </div>
            {{-- <div class="col-lg-6">
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
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Deviation Occurred On"> OOS occurred On </label>
                    <div><small class="text-primary"></small></div>
                    <div class="calenderauditee">
                        <input type="text" id="deviation_occured_on_gi" readonly 
                        value="{{ Helpers::getdateFormat($data['deviation_occured_on_gi'] ?? '') }}" {{Helpers::isOOSChemical($data->stage)}} placeholder="DD-MM-YYYY" />
                        <input type="date" name="deviation_occured_on_gi"
                         class="hide-input"
                            oninput="handleDateInput(this, 'deviation_occured_on_gi')" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Source Document Type">Reference document</label>
                   <input type="text" name="source_document_type_gi"  id="source_document_type_gi" 
                        value="{{ $data->source_document_type_gi ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference System Document</label>
                    <input type="text" name="reference_system_document_gi"  id="reference_system_document_gi" 
                        value="{{ $data->reference_system_document_gi ?? '' }}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                multiple     {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sub-head pt-3">OOS Information</div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Sample Type</label>
                    <select name="sample_type_gi"  {{Helpers::isOOSChemical($data->stage)}} >
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
                        name="product_material_name_gi" {{Helpers::isOOSChemical($data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Market</label>
                    <input type="text" name="market_gi" value="{{$data->market_gi}}" {{Helpers::isOOSChemical($data->stage)}}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Customer</label>
                    <input type="text" name="customer_gi" value="{{$data->customer_gi}}" {{Helpers::isOOSChemical($data->stage)}}>
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
                                    <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_product_code]" value="{{ $info_product_material['info_product_code'] ?? '' }}"></td>
                                    <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="info_product_material[{{ $loop->index }}][info_batch_no]" value="{{ $info_product_material['info_batch_no'] ?? '' }}"></td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}}  type="text" id="info_mfg_date_{{ $loop->index }}" readonly placeholder="MM-YYYY" name="info_product_material[{{ $loop->index }}][info_mfg_date]"
                                                     value="{{ Helpers::getdateFormat($info_product_material['info_mfg_date'] ?? '') }}"  />
                                                    <input     {{Helpers::isOOSChemical($data->stage)}} type="date" name="info_product_material[{{ $loop->index }}][info_mfg_date]" 
                                                    value="{{$info_product_material['info_mfg_date']}}" class="hide-input" oninput="handleDateInput(this, 'info_mfg_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" id="info_expiry_date_{{ $loop->index }}" value="{{ Helpers::getdateFormat($info_product_material['info_expiry_date'] ?? '') }}" readonly placeholder="MM-YYYY" />
                                                    <input  {{Helpers::isOOSChemical($data->stage)}} type="date" name="info_product_material[{{ $loop->index }}][info_expiry_date]" 
                                                    value="{{ $info_product_material['info_expiry_date'] ?? '' }}" class="hide-input" oninput="handleDateInput(this, 'info_expiry_date_{{ $loop->index }}')">
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
                                    <select {{Helpers::isOOSChemical($data->stage)}} class="facility-name" name="info_product_material[{{ $loop->index }}][info_packing_material_type]" id="facility_name">
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
                                <th style="width: 10%">Details of Obvious Error</th>
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
                                        <td><input {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_detail[{{ $loop->index }}][oos_details_obvious_error]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_details_obvious_error') }}"></td>
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
            <div class="button-block">
            @if ($data->stage == 0  || $data->stage >= 15)
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
