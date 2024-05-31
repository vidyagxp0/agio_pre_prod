

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
                        <option value="Yes" {{ $data->manufact_invest_required_piii === 'Yes' ? 'selected' :
                                '' }}>Yes</option>
                        <option value="No" {{ $data->manufact_invest_required_piii === 'No' ? 'selected' : ''
                                }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Auditee"> Manufacturing Invest. Type </label>
                    <select  name="manufacturing_invest_type_piii" placeholder="Select Nature of Deviation"
                        data-search="false" data-silent-initial-value-set="true" id="auditee">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="1" {{ $data->root_casue_identified_piiqcr === '1' ? 'selected' :
                                '' }}>Chemical</option>
                        <option value="2" {{ $data->root_casue_identified_piiqcr === '2' ? 'selected' : ''
                                }}>Microbiology</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Comments"> Audit Comments </label>
                    <textarea  class="summernote" type="audit_comments_piii" name="audit_comments_piii">{{$data->audit_comments_piii ? $data->audit_comments_piii : ""}}
                    </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Hypo/Exp. Required</label>
                    <select name="hypo_exp_required_piii">
                       <option value="0" {{ $data->hypo_exp_required_piii == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->hypo_exp_required_piii == 'yes' ?
                            'selected' : '' }}>yes</option>
                        <option value="no" {{ $data->hypo_exp_required_piii == 'no' ?
                            'selected' : '' }}>no</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Reference Recores">Hypo/Exp. Reference</label>
                    <textarea class="summernote" name="hypo_exp_reference_piii" id="summernote-1">
                    {{$data->hypo_exp_reference_piii ? $data->hypo_exp_reference_piii : ""}}</textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachments_pII">
                        @if ($data->file_attachments_pII)
                            @foreach ($data->file_attachments_pII as $file)
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
                            <input type="file" id="myfile" name="file_attachments_pII[]"
                                oninput="addMultipleFiles(this, 'file_attachments_pII')" multiple>
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