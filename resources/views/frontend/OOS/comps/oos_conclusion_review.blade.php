<div id="CCForm9" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Conclusion Review Comments
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion Review Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="conclusion_review_comments_ocr" id="summernote-1">
                        {{ $data->conclusion_review_comments_ocr ? $data->conclusion_review_comments_ocr : '' }}
                    </textarea>
                </div>
            </div>


            <!-- ---------------------------grid-1 ------"OOSConclusion_Review-------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Summary of OOS Test Results
                    <button type="button" name="audit-agenda-grid" id="oosconclusion_review">+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oosconclusion_review_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 16%">Material/Product Name</th>
                                <th style="width: 16%">Batch No.(s) / A.R. No. (s)</th>
                                <th style="width: 16%">Any Other Information</th>
                                <th style="width: 16%">Action Taken on Affec.batch</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($oos_conclusion_reviews)
                                @foreach ($oos_conclusion_reviews->data as $oos_conclusion_review)
                                    <tr>
                                        <td><input disabled type="text" name="oos_conclusion_review[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_product_name]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_product_name') }}"></td>
                                        <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_batch_no]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_batch_no') }}"></td>
                                        <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_any_other_information]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_any_other_information') }}"></td>
                                        <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_action_affecte_batch]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_action_affecte_batch') }}"></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>


            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Action Taken on Affec.batch</label>
                    <textarea class="summernote" name="action_taken_on_affec_batch_ocr" id="summernote-1">
                    {{ $data->action_taken_on_affec_batch_ocr ? $data->action_taken_on_affec_batch_ocr :'NA' }}
                </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">CAPA Req?</label>
                    <select name="capa_req_ocr">
                        <option value="Yes" {{ $data->capa_req_ocr == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $data->capa_req_ocr == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">CAPA Reference</label>
                    <select multiple id="reference_record" name="capa_refer_ocr[]">
                        <option value="0" {{ in_array('0', $data->capa_refer_ocr ?? []) ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="1" {{ in_array('1', $data->capa_refer_ocr ?? []) ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ in_array('2', $data->capa_refer_ocr ?? []) ? 'selected' : '' }}>2
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if No Risk Assessment</label>
                    <textarea class="summernote" name="justify_if_no_risk_assessment_ocr" id="summernote-1">
                            {{ $data->justify_if_no_risk_assessment_ocr ? $data->justify_if_no_risk_assessment_ocr : 'NA' }}
                        </textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Reference Recores">Conclusion Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="conclusion_attachment_ocr">

                            @if ($data->conclusion_attachment_ocr)
                            @foreach ($data->conclusion_attachment_ocr as $file)
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b>{{ $file }}</b>
                                <a href="{{ asset('upload/' . $file) }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name="{{ $file }}"><i
                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                            </h6>
                            @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="conclusion_attachment_ocr[]"
                                oninput="addMultipleFiles(this, 'conclusion_attachment_ocr')" multiple>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">CQ Approver</label>
                    <input type="text" name="cq_approver" value="{{$data->cq_approver ? $data->cq_approver : '' }}">
                </div>
            </div>

            <div class="button-block">
                <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                <button type="button" id="ChangeNextButton" class="nextButton" onclick="nextStep()">Next</button>
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                        Exit </a> </button>
            </div>
        </div>
    </div>
</div>