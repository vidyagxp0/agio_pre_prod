

<div id="CCForm5" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Phase II Investigation
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">QA Approver Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="qa_approver_comments_piii" id="summernote-1">
                    {{$data->qa_approver_comments_piii ? $data->qa_approver_comments_piii : ""}}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments"> Manufact. Invest. Required? </label>
                    <select name="manufact_invest_required_piii">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="1" {{ $data->root_casue_identified_piiqcr === '1' ? 'selected' :
                                '' }}>1</option>
                        <option value="2" {{ $data->root_casue_identified_piiqcr === '2' ? 'selected' : ''
                                }}>2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Auditee"> Manufacturing Invest. Type </label>
                    <select multiple name="manufacturing_invest_type_piii" placeholder="Select Nature of Deviation"
                        data-search="false" data-silent-initial-value-set="true" id="auditee">
                        <option value="1" {{ $data->root_casue_identified_piiqcr === '1' ? 'selected' :
                                '' }}>Chemical</option>
                        <option value="2" {{ $data->root_casue_identified_piiqcr === '2' ? 'selected' : ''
                                }}>Microbiology</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Manufacturing Invst. Ref.</label>
                    <select multiple id="reference_record" name="manufacturing_invst_ref_piii[]" id="">
                        <option value="0">--Select---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Re-sampling Required? </label>
                    <select name="re_sampling_required_piii">
                          <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Comments"> Audit Comments </label>
                    <textarea  input type="audit_comments_piii" name="audit_comments_piii">
                    {{$data->audit_comments_piii ? $data->audit_comments_piii : ""}}
                    </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Re-sampling Ref. No.</label>
                    <select multiple id="reference_record" name="re_sampling_ref_no_piii" id="">
                        <option value="0">--Select---</option>
                        <option value="yes" {{ $data->root_casue_identified_piiqcr === '1' ? 'selected' :
                                '' }}>1</option>
                        <option value="no" {{ $data->root_casue_identified_piiqcr === '2' ? 'selected' : ''
                                }}>2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Hypo/Exp. Required</label>
                    <select name="hypo_exp_required_piii">
                       <option value="0">--Select---</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>

                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Hypo/Exp. Reference</label>
                    <select multiple id="reference_record" name="hypo_exp_reference_piii" id="">
                        <option value="0">--Select---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attachments_pli[]"
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
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