<div id="CCForm3" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Investigation Conclusion</div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary of Preliminary Investigation</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="summary_of_prelim_investiga_plic"
                        id="summernote-1">
                    {{ $data->summary_of_prelim_investiga_plic ? $data->summary_of_prelim_investiga_plic : ''}}</textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Lead Auditor">Root Cause Identified</label>
                    <!-- <div class="text-primary">Please Choose the relevent units</div> -->
                    <select name="root_cause_identified_plic">
                        <option value="0" {{ $data->root_cause_identified_plic == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->root_cause_identified_plic == 'yes' ? 'selected' :
                            '' }}>yes</option>
                        <option value="no" {{ $data->root_cause_identified_plic == 'no' ? 'selected' :
                            '' }}>no</option>

                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Team"> OOS Category-Root Cause Ident.</label>
                    <select name="oos_category_root_cause_ident_plic">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="analyst_error" {{ $data->oos_category_root_cause_ident_plic ==
                            'analyst_error' ? 'selected' : '' }}>Analyst Error</option>
                        <option value="instrument_error" {{ $data->oos_category_root_cause_ident_plic ==
                            'instrument_error' ? 'selected' : '' }}>Instrument Error</option>
                        <option value="product_material_error" {{ $data->
                            oos_category_root_cause_ident_plic == 'product_material_error' ? 'selected'
                            : '' }}>Product/Material Related Error</option>
                        <option value="other_error" {{ $data->oos_category_root_cause_ident_plic ==
                            'other_error' ? 'selected' : '' }}>Other Error</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">OOS Category (Others)</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                            require completion</small></div>
                    <textarea class="summernote" name="oos_category_others_plic" id="summernote-1"
                        value="">
                   {{ $data->oos_category_others_plic }}
 
                   </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Root Cause Details</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="root_cause_details_plic" id="summernote-1">
                   {{ $data->root_cause_details_plic }}
                </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">OOS Category-Root Cause Ident.</label>
                    <div><small class="text-primary">Please insert "NA" in the data field if it does not
                            require completion </small></div>
                    <textarea class="summernote" name="Description_Deviation" id="summernote-1"
                        value="">{{ $data->Description_Deviation ? $data->Description_Deviation : '' }}
                    </textarea>
                </div>
            </div>

           
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">CAPA Required</label>
                    <select name="capa_required_plic">
                        <option value="0" {{ $data->capa_required_plic == '0' ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="yes" {{ $data->capa_required_plic == 'yes' ? 'selected' : ''
                            }}>Yes</option>
                        <option value="no" {{ $data->capa_required_plic == 'no' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Agenda">Reference CAPA No.</label>
                    <input type="text" value="{{$data->reference_capa_no_plic}}"
                        name="reference_capa_no_plic">
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Delay Justification for Preliminary Investigation</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="delay_justification_for_pi_plic"
                        id="summernote-1" value="">
                     {{ $data->delay_justification_for_pi_plic ? $data->delay_justification_for_pi_plic : ''  }}

                </textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Attachments"> Supporting Attachment </label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="supporting_attachment_plic">

                            @if ($data->supporting_attachment_plic)
                            @foreach ($data->supporting_attachment_plic as $file)
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
                            <input type="file" id="myfile" name="supporting_attachment_plic[]"
                                oninput="addMultipleFiles(this, 'supporting_attachment_plic')" multiple>
                        </div>
                    </div>



                </div>
            </div>

            <div class="button-block">
                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                <button type="button" id="ChangeNextButton" class="nextButton"
                    onclick="nextStep()">Next</button>
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                        Exit </a> </button>
            </div>
        </div>
    </div>
</div>