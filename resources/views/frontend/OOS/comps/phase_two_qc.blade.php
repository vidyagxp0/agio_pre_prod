<div id="CCForm6" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Summary of Phase II Testing</div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary of Exp./Hyp.</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="summary_of_exp_hyp_piiqcr" id="summernote-1">
                {{$data->summary_of_exp_hyp_piiqcr ?  $data->summary_of_exp_hyp_piiqcr : ''}}
                </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary Mfg. Investigation</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="summary_mfg_investigation_piiqcr" id="summernote-1">
                {{$data->summary_mfg_investigation_piiqcr ? $data->summary_mfg_investigation_piiqcr : ''}}
                        
                </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Cancelled By"> Root Casue Identified. </label>
                    <select name="root_casue_identified_piiqcr">
                    <option value="0" {{ $data->oos_category_reason_identified_piiqcr === '0' ?
                            'selected' : '' }}>Enter Your Selection Here</option>

                        <option value="yes" {{ $data->root_casue_identified_piiqcr === 'yes' ? 'selected' :
                            '' }}>Yes</option>
                        <option value="no" {{ $data->root_casue_identified_piiqcr === 'no' ? 'selected' : ''
                            }}>No</option>

                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Cancelled By">OOS Category-Reason identified </label>
                    <select name="oos_category_reason_identified_piiqcr">
                        <option value="0" {{ $data->oos_category_reason_identified_piiqcr === '0' ?
                            'selected' : '' }}>Enter Your Selection Here</option>
                        <option value="analyst_error" {{ $data->oos_category_reason_identified_piiqcr ===
                            'analyst_error' ? 'selected' : '' }}>Analyst Error</option>
                        <option value="instrument_error" {{ $data->oos_category_reason_identified_piiqcr ===
                            'instrument_error' ? 'selected' : '' }}>Instrument Error</option>
                        <option value="product_material_related_error" {{ $data->
                            oos_category_reason_identified_piiqcr === 'product_material_related_error' ?
                            'selected' : '' }}>Product/Material Related Error</option>
                        <option value="other_error" {{ $data->oos_category_reason_identified_piiqcr ===
                            'other_error' ? 'selected' : '' }}>Other Error</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Preparation Completed On">Others (OOS category)</label>
                    <input type="text" name="others_oos_category_piiqcr"
                        value="{{$data->others_oos_category_piiqcr}}">
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Details of Root Cause</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="details_of_root_cause_piiqcr" id="summernote-1">
                {{$data->impact_assessment_piiqcr ? $data->impact_assessment_piiqcr : ''}}
                </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Impact Assessment.</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="impact_assessment_piiqcr" id="summernote-1">
                  {{$data->impact_assessment_piiqcr ? $data->impact_assessment_piiqcr : ""}}
                </textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Lead More Info Reqd On">Attachments </label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="attachments_piiqcr">

                            @if ($data->attachments_piiqcr)
                            @foreach($data->attachments_piiqcr as $file)
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
                            <input type="file" id="myfile" name="attachments_piiqcr[]"
                                oninput="addMultipleFiles(this, 'attachments_piiqcr')" multiple>
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