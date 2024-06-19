<div id="CCForm1" class="inner-block cctabcontent">
                 <div class="inner-block-content"><div class="sub-head">General Information</div>
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Initiator Group">Type </label>
                            <select id="dynamicSelectType" name="type">
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
                     <input disabled type="text" name="record_number"
                      value="{{ Helpers::getDivisionName($micro_data->division_id) }}/OOS Chemical/{{ Helpers::year($micro_data->created_at) }}/{{ $micro_data->record_number ? str_pad($micro_data->record_number, 4, "0", STR_PAD_LEFT ) : '1' }}">
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
                    <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                    <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                </div>
            </div>
            <div class="col-lg-6 new-date-data-field">
                <div class="group-input input-date">
                    <label for="Date Due"> Due Date </label>
                    <div><small class="text-primary">If revising Due Date, kindly mention revision
                            reason in "Due Date Extension Justification" data field.</small></div>
                    <div class="calenderauditee">
                        <input type="text" id="due_date" readonly value="{{ Helpers::getdateFormat($micro_data['due_date'] ?? '') }}" placeholder="DD-MM-YYYY" />
                        <input type="date" name="due_date"
                            min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                            oninput="handleDateInput(this, 'due_date')" />
                    </div>
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Short Description
                        <span class="text-danger">*</span></label>
                        <span id="rchars">255</span>characters remaining
                    <textarea id="docname"  name="description_gi" maxlength="255" required>{{ $micro_data->description_gi }}</textarea>
                </div>
            </div>
            <p id="docnameError" style="color:red">**Short Description is required</p>                                                                                 
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description"> Severity Level</label>
                    <select name="severity_level_gi">
                        <option value="">Enter Your Selection Here</option>
                        <option value="Major" {{ $micro_data->severity_level_gi == 'Major' ? 'selected' :
                            '' }}>Major</option>
                        <option value="Minor" {{ $micro_data->severity_level_gi == 'Minor' ? 'selected' :
                            '' }}>Minor</option>
                        <option value="Critical" {{ $micro_data->severity_level_gi == 'Critical' ? 'selected' :
                        '' }}>Critical</option>
                    </select>
                </div>
            </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group"><b>Initiator Group</b></label>
                                <select name="initiator_group_gi" id="initiator_group">
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
                                <label for="Initiator Group Code">Initiator Group </label>
                                <input type="text" name="initiator_group_code_gi" id="initiator_group_code"
                                    value="{{ $micro_data->initiator_group_code_gi }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initiated Through ?</label>
                                <select name="initiated_through_gi"
                                    onchange="otherController(this.value, 'others', 'initiated_through_req')">
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
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group Code">If Others </label>
                                <textarea name="if_others_gi">{{ $micro_data->if_others_gi }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Is Repeat ?</label>
                                <select name="is_repeat_gi"
                                        onchange="otherController(this.value, 'Yes', 'repeat_nature')">
                                        <option value="">Enter Your Selection Here</option>
                                        <option value="Yes" @if ($micro_data->is_repeat_gi == 'Yes') selected @endif>Yes</option>
                                        <option value="No" @if ($micro_data->is_repeat_gi == 'No') selected @endif>No</option>
                                        <option value="NA" @if ($micro_data->is_repeat_gi == 'NA') selected @endif>NA</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-4">
                            <div class="group-input">
                                <label for="Initiator Group">Repeat Nature</label>
                                <textarea name="repeat_nature_gi">{{ $micro_data->repeat_nature_gi }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Nature of Change</label>
                                <select name="nature_of_change_gi">
                                    <option>Enter Your Selection Here</option>
                                    <option value="temporary" {{ $micro_data->nature_of_change_gi == 'temporary' ?
                                        'selected' : '' }}>temporary</option>
                                    <option value="permanent" {{ $micro_data->nature_of_change_gi == 'permanent' ?
                                        'selected' : '' }}>permanent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 new-date-data-field">
                            <div class="group-input input-date">
                                <label for="Deviation Occurred On"> Deviation Occurred On </label>
                                <div><small class="text-primary">If revising Due Date, kindly mention revision
                                        reason in "Due Date Extension Justification" data field.</small></div>
                                <div class="calenderauditee">
                                    <input type="text" id="deviation_occured_on_gi" readonly value="{{ Helpers::getdateFormat($micro_data['deviation_occured_on_gi'] ?? '') }}" placeholder="DD-MM-YYYY" />
                                    <input type="date" name="deviation_occured_on_gi"
                                        min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" class="hide-input"
                                        oninput="handleDateInput(this, 'deviation_occured_on_gi')" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
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
                                            <a type="button" class="remove-file"
                                                data-file-name="{{ $file }}"><i
                                                    class="fa-solid fa-circle-xmark"
                                                    style="color:red; font-size:20px;"></i></a>
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
                                        oninput="addMultipleFiles(this, 'initial_attachment_gi')" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Source Document Type</label>
                                <select name="source_document_type_gi">
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
                                <select multiple id="reference_record" name="reference_system_document_gi[]" id="">
                                <option value="1" {{ (!empty($micro_data->reference_system_document_gi) && in_array('1', explode(',', $micro_data->reference_system_document_gi[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->reference_system_document_gi) && in_array('2', explode(',', $micro_data->reference_system_document_gi[0]))) ? 'selected' : '' }}>2</option>
                               </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Reference Document</label>
                                <select multiple id="reference_record" name="reference_document_gi[]">
                                    <option value="1" {{ (!empty($micro_data->reference_document_gi) && in_array('1', explode(',', $micro_data->reference_document_gi[0]))) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (!empty($micro_data->reference_document_gi) && in_array('2', explode(',', $micro_data->reference_document_gi[0]))) ? 'selected' : '' }}>2</option>
                                </select>
                            </div>
                        </div>
                        <div class="sub-head pt-3">OOS Information</div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Tnitiaror Grouo">Sample Type</label>
                                <select name="sample_type_gi">
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
                                <input type="text" name="product_material_name_gi" value="{{ $micro_data->product_material_name_gi }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Market</label>
                                <input type="text" name="market_gi" value="{{ $micro_data->market_gi }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input ">
                                <label for="Short Description ">Customer*</label>
                                <select name="customer_gi">
                                    <option>Enter Your Selection Here</option>
                                    <option value="1" @if ($micro_data->customer_gi == 1) selected @endif>1</option>
                                    <option value="2" @if ($micro_data->customer_gi == 2) selected @endif>2</option>
                                </select>
                            </div>
                        </div>
                        <!-- ---------------------------grid-1 -------------------------------- -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Info. On Product/ Material
                                <button type="button" name="audit-agenda-grid" id="Product_Material">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="Product_Material_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 10%">Item/Product Code</th>
                                            <th style="width: 8%"> Batch No*.</th>
                                            <th style="width: 8%"> Mfg.Date</th>
                                            <th style="width: 8%">Expiry Date</th>
                                            <th style="width: 8%"> Label Claim.</th>
                                            <th style="width: 8%">Pack Size</th>
                                            <th style="width: 8%">Analyst Name</th>
                                            <th style="width: 10%">Others (Specify)</th>
                                            <th style="width: 10%"> In- Process Sample Stage.</th>
                                            <th style="width: 12% pt-3">Packing Material Type</th>
                                            <th style="width: 16% pt-2"> Stability for</th>
                                        </tr>
                                    </thead>
                                    @php
                                        $serialNumber= 1;
                                    @endphp

                                <tbody>
                                    @php
                                        $serialNumber =1;
                                    @endphp
                                        @foreach ($oosMgrid->data as $oosm)
                                        <td disabled >{{$serialNumber++}}</td>
                                        <td><input type="text" name="productMaterial[0][item_product_code]" value="{{$oosm['item_product_code']}}"></td>
                                        <td><input type="text" name="productMaterial[0][batch_no]" value="{{$oosm['batch_no']}}"></td>
                                        <td><input type="text" name="productMaterial[0][mfg_date]" value="{{$oosm['mfg_date']}}"></td>
                                        <td><input type="text" name="productMaterial[0][expiry_date]" value="{{$oosm['expiry_date']}}"></td>
                                        <td><input type="text" name="productMaterial[0][label_claim]" value="{{$oosm['label_claim']}}"></td>
                                        <td><input type="text" name="productMaterial[0][pack_size]" value="{{$oosm['pack_size']}}"></td>
                                        <td><input type="text" name="productMaterial[0][analyst_name]" value="{{$oosm['analyst_name']}}"></td>
                                        <td><input type="text" name="productMaterial[0][others_specify]" value="{{$oosm['others_specify']}}"></td>
                                        <td><input type="text" name="productMaterial[0][in_process_sample_stage]" value="{{$oosm['in_process_sample_stage']}}"></td>
                                        <td><select name="productMaterial[0][packingMaterialType]" value="{{$oosm['packingMaterialType']}}">
                                                <option value='primary'>Primary</option>
                                                <option value='Secondary'>Secondary</option>
                                                <option value='tertiary'>Tertiary</option>
                                                <option value='not applicable'>Not Applicable</option>
                                            </select> </td>
                                        <td><select name="productMaterial[0][stabilityfor]" value="{{$oosm['stabilityfor']}}">
                                                <option value='Submission'>Submission</option>
                                                <option value='commercial'>Commercial</option>
                                                <option value='pack evaluation'>Pack Evaluation</option>
                                                <option value='not applicable'>Not Applicable</option>
                                            </select> </td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- -------------------------------grid-2  ----------------------------------   -->
                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                Details of Stability Study
                                <button type="button" name="audit-agenda-grid" id="Details_Stability">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="Details_Stability_details" style="width: 100%;">
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

                                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($oosM2grid->data as $oosm2)
                            <td disabled >{{$serialNumber++}}</td>
                            <td><input type="text" name="stability_study[0][ar_number]"  value="{{$oosm2['ar_number']}}" ></td>
                            <td><input type="text" name="stability_study[0][condition_temperature_rh]" value="{{$oosm2['condition_temperature_rh']}}"></td>
                            <td><input type="text" name="stability_study[0][interval]" value="{{$oosm2['interval']}}"></td>
                            <td><input type="text" name="stability_study[0][orientation]" value="{{$oosm2['orientation']}}"></td>
                            <td><input type="text" name="stability_study[0][pack_details]" value="{{$oosm2['pack_details']}}"></td>
                            <td><input type="text" name="stability_study[0][specification_no]" value="{{$oosm2['specification_no']}}"></td>
                            <td><input type="text" name="stability_study[0][sample_description]" value="{{$oosm2['sample_description']}}"></td>
                        @endforeach
                        </tbody>

                                </table>
                            </div>
                        </div>
                        <!--
                                            ------------------------------------------grid-3----------------------------------- -->

                        <div class="group-input">
                            <label for="audit-agenda-grid">
                                OOS Details
                                <button type="button" name="audit-agenda-grid" id="OOS_Details">+</button>
                                <span class="text-primary" data-bs-toggle="modal"
                                    data-bs-target="#document-details-field-instruction-modal"
                                    style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                    (Launch Instruction)
                                </span>
                            </label>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="OOS_Details_details" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 4%">Row#</th>
                                            <th style="width: 8%">AR Number.</th>
                                            <th style="width: 8%">Test Name of OOS</th>
                                            <th style="width: 12%">Results Obtained</th>
                                            <th style="width: 16%">Specification Limit</th>
                                            <th style="width: 16%">Details of Obvious Error</th>
                                            <th style="width: 16%">File Attachment</th>
                                            {{-- <th style="width: 16%">Submit By</th>
                                            <th style="width: 16%">Submit On</th> --}}

                                        </tr>
                                    </thead>
                                    <tbody>
                            @foreach ($oosM3grid->data as $oosm3)

                            <td disabled >{{$serialNumber++}}</td>
                                        <td><input type="text" name="oos_details[0][ar_number]"  value="{{$oosm3['ar_number']}}"></td>
                                        <td><input type="text" name="oos_details[0][test_name_of_oos]" value="{{$oosm3['test_name_of_oos']}}"></td>
                                        <td><input type="text" name="oos_details[0][results_obtained]" value="{{$oosm3['results_obtained']}}"></td>
                                        <td><input type="text" name="oos_details[0][specification_limit]" value="{{$oosm3['specification_limit']}}"></td>
                                        <td><input type="text" name="oos_details[0][details_of_obvious_error]" value="{{$oosm3['details_of_obvious_error']}}"></td>
                                        <td> <input type="file" name="oos_details[0][file_attachment_oos_details][]"
                                            value="@isset($oosm3['file_attachment_oos_details']){{ $oosm3['file_attachment_oos_details'] }}@endisset">
                                 </td>
                                        {{-- <td><input type="text" name="text[]"></td>
                                        <td><input type="date" name="time[]"></td> --}}


                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                        <div class="button-block">
                            <button type="submit" class="saveButton">Save</button>
                            <!-- <button type="button" class="backButton" onclick="previousStep()">Back</button> -->
                            <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                                    Exit </a> </button>
                        </div>
                        </div>
                    </div>
                </div>