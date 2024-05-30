<div id="CCForm1" class="inner-block cctabcontent">
    <div class="inner-block-content">

        <div class="sub-head">General Information</div>
        <div class="row">
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Type </label>
                    <select id="dynamicSelectType" name="type">
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
                    <input disabled type="text" value="{{ date('d-M-Y') }}" name="intiation_date">
                    <input type="hidden" value="{{ date('Y-m-d') }}" name="intiation_date">
                    </div>
                </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator"> Due Date
                    </label>

                    <small class="text-primary">
                        Please mention expected date of completion
                    </small>
                    <input type="date" name="due_date" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" 
                    class="hide-input" oninput="handleDateInput(this, 'due_date')" value="{{ $data->due_date ?? '' }}"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description"> Severity Level</label>
                    <select name="severity_level_gi">
                        <option value="o">Enter Your Selection Here</option>
                        <option value="Major" {{ $data->severity_level_gi == 'Major' ? 'selected' :
                            '' }}>Major</option>
                        <option value="Minor" {{ $data->severity_level_gi == 'Minor' ? 'selected' :
                            '' }}>Minor</option>
                        <option value="Critical" {{ $data->severity_level_gi == 'Critical' ? 'selected' :
                        '' }}>Critical</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Short Description</label>
                    <textarea name="description_gi" required>{{ $data->description_gi }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description">Initiator Group <span
                            class="text-danger"></span></label>
                    <select name="initiator_group" id="initiator_group">
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
                    <label for="Short Description">Initiator Group Code <span
                            class="text-danger"></span></label>
                    <input type="text" name="initiator_group_code"  id="initiator_group_code" readonly
                        value="{{ $data->initiator_group_code ?? '' }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">If Others</label>
                    <textarea type="if_others_gi"
                        name="if_others_gi">{{ $data->if_others_gi }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group Code">Is Repeat?</label>
                    
                        <select name="is_repeat_gi">
                        <option value="o" {{ $data->is_repeat_gi == 'o' ? 'selected' : '' }}>Enter Your
                            Selection Here</option>
                        <option value="yes" {{ $data->is_repeat_gi == 'yes' ? 'selected' : '' }}>yes</option>
                        <option value="No" {{ $data->is_repeat_gi == '2' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6 mt-4">
                <div class="group-input">
                    <label for="Initiator Group">Repeat Nature</label>
                    <textarea type="text"
                        name="repeat_nature_gi">{{ $data->repeat_nature_gi }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Nature of Change</label>
                    <select name="nature_of_change_gi">
                      <option value="0" {{ $data->nature_of_change_gi == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="temporary" {{ $data->nature_of_change_gi == 'temporary' ?
                            'selected' : '' }}>temporary</option>
                        <option value="permanent" {{ $data->nature_of_change_gi == 'permanent' ?
                            'selected' : '' }}>permanent</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Deviation Occurred On</label>
                    <input type="date" name="deviation_occured_on_gi"
                        value="{{ $data->deviation_occured_on_gi }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">Initial Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>

                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="">
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
                            <input type="file" id="myfile" name="initial_attachment_gi[]" oninput=""
                                multiple>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">

                <div class="group-input">
                    <label for="Source Document Type">Source Document Type</label>
                    <select name="source_document_type_gi">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="1" {{ $data->if_others_gi == '1' ? 'selected' : '' }}>doc</option>
                        <option value="2" {{ $data->if_others_gi == '2' ? 'selected' : '' }}>pdf</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference System Document</label>
                    <select multiple id="reference_record" name="reference_system_document_gi" id="">
                        <option value="o">Enter Your Selection Here</option>
                        <option value="1" {{ $data->severity_level_gi == '1' ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ $data->severity_level_gi == '2' ? 'selected' : '' }}>2
                        </option>

                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference Document</label>
                    <select multiple id="reference_record" name="reference_document[]" id="">
                        <option value="0">--Select---</option>
                        <option value="1" {{ $data->reference_document == '1' ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ $data->reference_document == '2' ? 'selected' : '' }}>2
                        </option>
                    </select>
                </div>
            </div>
            <div class="sub-head pt-3">OOS Information</div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Tnitiaror Grouo">Sample Type</label>
                    <select name="sample_type_gi">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="raw_material" {{ $data->sample_type_gi == 'raw_material' ?
                            'selected' : '' }}>Raw Material</option>
                        <option value="packing_material" {{ $data->sample_type_gi == 'packing_material'
                            ? 'selected' : '' }}>Packing Material</option>
                        <option value="finished_product" {{ $data->sample_type_gi == 'finished_product'
                            ? 'selected' : '' }}>Finished Product</option>
                        <option value="stability_sample" {{ $data->sample_type_gi == 'stability_sample'
                            ? 'selected' : '' }}>Stability Sample</option>
                        <option value="others" {{ $data->sample_type_gi == 'others' ? 'selected' : ''
                            }}>Others</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Short Description ">Product / Material Name</label>

                    <input type="text" value="{{$data->product_material_name_gi}}"
                        name="product_material_name_gi">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input ">
                    <label for="Short Description ">Market</label>
                    <input type="text" name="market_gi" value="{{$data->market_gi}}">
                </div>
            </div>
            <div class="col-1g-5">
                <div class="group-input">
                    <label for="Initiator Group">Customer*</label>
                    <select name="customer_gi">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="yes" {{ $data->customer_gi == 'yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="no" {{ $data->customer_gi == 'no' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
            </div>
            <!-- ---------------------------grid-1 -------------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="Info_Product_Material">+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="Info_Product_Material_details"
                        style="width: 100%;">
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
                        <tbody>
                            @if($info_product_materials && is_array($info_product_materials->data))
                                @foreach($info_product_materials->data as $info_product_material)
                                    <tr>
                                        <td><input disabled type="text" name="info_product_material[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_product_code]" value="{{ Helpers::getArrayKey($info_product_material, 'info_product_code') }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_batch_no]" value="{{ Helpers::getArrayKey($info_product_material, 'info_batch_no') }}"></td>
                                        <td><input type="date" name="info_product_material[{{ $loop->index }}][info_mfg_date]" value="{{ Helpers::getArrayKey($info_product_material, 'info_mfg_date') }}"></td>
                                        <td><input type="date" name="info_product_material[{{ $loop->index }}][info_expiry_date]" value="{{ Helpers::getArrayKey($info_product_material, 'info_expiry_date') }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_label_claim]" value="{{ Helpers::getArrayKey($info_product_material, 'info_label_claim') }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_pack_size]" value="{{ Helpers::getArrayKey($info_product_material, 'info_pack_size') }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_analyst_name]" value="{{ Helpers::getArrayKey($info_product_material, 'info_analyst_name') }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_others_specify]" value="{{ Helpers::getArrayKey($info_product_material, 'info_others_specify') }}"></td>
                                        <td><input type="text" name="info_product_material[{{ $loop->index }}][info_process_sample_stage]" value="{{ Helpers::getArrayKey($info_product_material, 'info_process_sample_stage') }}"></td>
                                        <td>
                                            <select name="info_product_material[{{ $loop->index }}][info_packing_material_type]">
                                                <option value="Primary">Primary</option>
                                                <option value="Secondary">Secondary</option>
                                                <option value="Tertiary">Tertiary</option>
                                                <option value="Not Applicable">Not Applicable</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="info_product_material[{{ $loop->index }}][info_stability_for]">
                                                <option vlaue="Submission">Submission</option>
                                                <option vlaue="Commercial">Commercial</option>
                                                <option vlaue="Pack Evaluation">Pack Evaluation</option>
                                                <option vlaue="Not Applicable">Not Applicable</option>
                                            </select>
                                        </td>
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
                    <button type="button" name="audit-agenda-grid" id="Details_Stability">+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="Details_Stability_details"
                        style="width: 100%;">
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
                        @if($details_stabilities && is_array($details_stabilities->data))
                            @foreach ($details_stabilities->data as $details_stabilitie)
                                <tr>
                                    <td><input disabled type="text" name="details_stability[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_arnumber]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_arnumber') }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_condition_temprature_rh]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_condition_temprature_rh') }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_Interval]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_Interval') }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_orientation]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_orientation') }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_pack_details]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_pack_details') }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_specification_no]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_specification_no') }}"></td>
                                    <td><input type="text" name="details_stability[{{ $loop->index }}][stability_study_sample_description]" value="{{ Helpers::getArrayKey($details_stabilitie, 'stability_study_sample_description') }}"></td> 
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
                                <th style="width: 16%">Submit By</th>
                                <th style="width: 16%">Submit On</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($oos_details && is_array($oos_details->data))
                                @foreach ($oos_details->data as $oos_detail)
                                    <tr>
                                        <td><input disabled type="text" name="oos_detail[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input type="text" name="oos_detail[{{ $loop->index }}][oos_arnumber]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_arnumber') }}"></td>
                                        <td><input type="text" name="oos_detail[{{ $loop->index }}][oos_test_name]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_test_name') }}"></td>
                                        <td><input type="text" name="oos_detail[{{ $loop->index }}][oos_results_obtained]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_results_obtained') }}"></td>
                                        <td><input type="text" name="oos_detail[{{ $loop->index }}][oos_specification_limit]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_specification_limit') }}"></td>
                                        <td><input type="text" name="oos_detail[{{ $loop->index }}][oos_details_obvious_error]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_details_obvious_error') }}"></td>
                                        {{-- <td><input type="file" name="oos_detail[{{ $loop->index }}][oos_file_attachment]" value="{{ Helpers::getArrayKey($oos_detail->oos_file_attachment, 'oos_file_attachment') }}"></td> --}}
                                        <td><input type="text" name="oos_detail[{{ $loop->index }}][oos_submit_by]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_submit_by') }}"></td>
                                        <td><input type="date" name="oos_detail[{{ $loop->index }}][oos_submit_on]" value="{{ Helpers::getArrayKey($oos_detail, 'oos_submit_on') }}"></td>
                                    </tr>
                                @endforeach
                            @endif
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
