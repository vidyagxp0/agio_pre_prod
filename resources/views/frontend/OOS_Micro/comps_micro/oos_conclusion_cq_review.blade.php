<!--OOS Conclusion  -->
<div id="CCForm8" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Conclusion Comments
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion Comments</label>
                            <textarea class="summernote" name="conclusion_comments_oosc" id="summernote-1">{{ $micro_data->conclusion_comments_oosc }}
                                    </textarea>
                        </div>
                    </div>
                     <!-- ---------------------------grid-1 -------------------------------- -->
                    <div class="group-input">
                        <label for="audit-agenda-grid">
                            Summary of OOS Test Results
                            <button type="button" name="audit-agenda-grid" id="oos_conclusion">+</button>
                            <span class="text-primary" data-bs-toggle="modal"
                                data-bs-target="#document-details-field-instruction-modal"
                                style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                                (Launch Instruction)
                            </span>
                        </label>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="oos_conclusion_details" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 4%">Row#</th>
                                        <th style="width: 16%">Analysis Detials</th>
                                        <th style="width: 16%">Hypo./Exp./Add.Test PR No.</th>
                                        <th style="width: 16%">Results</th>
                                        <th style="width: 16%">Analyst Name.</th>
                                        <th style="width: 16%">Remarks</th>
                                        <th style="width: 4%"> Action </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (!empty($oos_conclusions) && is_array($oos_conclusions->data))
                                    @foreach ($oos_conclusions->data as $oos_conclusion)
                                        <tr>
                                            <td><input disabled type="text" name="oos_conclusion[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                            <td><input type="text" name="oos_conclusion[{{ $loop->index }}][summary_results_analysis_detials]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analysis_detials') }}"></td>
                                            <td><input type="text" name="oos_conclusion[{{ $loop->index }}][summary_results_hypothesis_experimentation_test_pr_no]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_hypothesis_experimentation_test_pr_no') }}"></td>
                                            <td><input type="text" name="oos_conclusion[{{ $loop->index }}][summary_results]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results') }}"></td>
                                            <td><input type="text" name="oos_conclusion[{{ $loop->index }}][summary_results_analyst_name]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analyst_name') }}"></td>
                                            <td><input type="text" name="oos_conclusion[{{ $loop->index }}][summary_results_remarks]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_remarks') }}"></td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td><input disabled type="text" name="oos_conclusion[0][serial]" value="1"></td>
                                        <td><input type="text" name="oos_conclusion[0][summary_results_analysis_detials]"></td>
                                        <td><input type="text" name="oos_conclusion[0][summary_results_hypothesis_experimentation_test_pr_no]"></td>
                                        <td><input type="text" name="oos_conclusion[0][summary_results]"></td>
                                        <td><input type="text" name="oos_conclusion[0][summary_results_analyst_name]"></td>
                                        <td><input type="text" name="oos_conclusion[0][summary_results_remarks]"></td> 
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments">Specification Limit </label>
                            <input type="text" name="specification_limit_oosc" value="{{ $micro_data->specification_limit_oosc }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Results to be Reported</label>
                            <select name="results_to_be_reported_oosc">
                                <option value="">Enter Your Selection Here</option>
                                <option value="initial" @if ($micro_data->results_to_be_reported_oosc == 'initial') selected @endif>Initial</option>
                                <option value="retested-result" @if ($micro_data->results_to_be_reported_oosc == 'retested-result') selected @endif>Retested Result</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Final Reportable Results</label>
                            <input type="text" name="final_reportable_results_oosc" value="{{ $micro_data->final_reportable_results_oosc }}">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justifi. for Averaging Results</label>
                            <textarea class="summernote" name="justifi_for_averaging_results_oosc" id="summernote-1">{{ $micro_data->justifi_for_averaging_results_oosc }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">OOS Stands </label>
                            <select name="oos_stands_oosc">
                                <option value="">Enter Your Selection Here</option>
                                <option value="valid" @if ($micro_data->oos_stands_oosc == 'valid') selected @endif>Valid</option>
                                <option value="invalid" @if ($micro_data->oos_stands_oosc == 'invalid') selected @endif>Invalid</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CAPA Req.</label>
                            <select name="capa_req_oosc">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->capa_req_oosc == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->capa_req_oosc == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">CAPA Ref No.</label>
                            <select multiple id="reference_record" name="capa_ref_no_oosc[]" id="">
                                <option value="">--Select Option---</option>
                                <option value="1" {{ (!empty($micro_data->capa_ref_no_oosc) && in_array('1', explode(',', $micro_data->capa_ref_no_oosc[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->capa_ref_no_oosc) && in_array('2', explode(',', $micro_data->capa_ref_no_oosc[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify if CAPA not required</label>
                            <textarea class="summernote" name="justify_if_capa_not_required_oosc" id="summernote-1">{{ $micro_data->justify_if_capa_not_required_oosc }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Action Plan Req.</label>
                            <select name="action_plan_req_oosc">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->action_plan_req_oosc == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->action_plan_req_oosc == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Plan Ref.</label>
                            <select multiple id="reference_record" name="action_plan_ref_oosc[]" id="">
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->action_plan_ref_oosc) && in_array('1', explode(',', $micro_data->action_plan_ref_oosc[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->action_plan_ref_oosc) && in_array('2', explode(',', $micro_data->action_plan_ref_oosc[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justification for Delay</label>
                           <textarea class="summernote" name="justification_for_delay_oosc" id="summernote-1">{{ $micro_data->justification_for_delay_oosc }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Attachments if Any</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="attachments_if_any_oosc">
                                    @if ($micro_data->attachments_if_any_oosc)
                                    @foreach ($micro_data->attachments_if_any_oosc as $file)
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
                                </div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="attachments_if_any_oosc[]"
                                        oninput="addMultipleFiles(this, 'attachments_if_any_oosc')" multiple>
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

       <!--OOS Conclusion Review -->
        <div id="CCForm9" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Conclusion Review Comments
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Conclusion Review Comments</label>
                            <textarea class="summernote" name="conclusion_review_comments_ocr" id="summernote-1">{{ $micro_data->conclusion_review_comments_ocr }}
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
                                    <th style="width: 16%">Product Name</th>
                                    <th style="width: 16%">Batch No.</th>
                                    <th style="width: 16%">Other Information</th>
                                    <th style="width: 16%">Action Affecte Batch</th>
                                    <th style="width: 4%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($oos_conclusion_reviews) && is_array($oos_conclusion_reviews->data))
                                    @foreach ($oos_conclusion_reviews->data as $oos_conclusion_review)
                                        <tr>
                                            <td><input disabled type="text" name="oos_conclusion_review[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                            <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_product_name]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_product_name') }}"></td>
                                            <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_batch_no]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_batch_no') }}"></td>
                                            <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_any_other_information]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_any_other_information') }}"></td>
                                            <td><input type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_action_affecte_batch]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_action_affecte_batch') }}"></td>
                                            <td><button type="text" class="removeRowBtn">Remove</button></td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td><input disabled type="text" name="oos_conclusion_review[0][serial]" value="1"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_product_name]"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_batch_no]"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_any_other_information]"></td>
                                    <td><input type="text" name="oos_conclusion_review[0][conclusion_review_action_affecte_batch]"></td>
                                    <td><button type="text" class="removeRowBtn">Remove</button></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Action Taken on Affec.batch</label>
                            <textarea class="summernote" name="action_taken_on_affec_batch_ocr" id="summernote-1">{{ $micro_data->action_taken_on_affec_batch_ocr }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CAPA Req?</label>
                            <select name="capa_req_ocr">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->capa_req_ocr == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->capa_req_ocr == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">CAPA Refer.</label>
                            <select multiple id="reference_record" name="capa_refer_ocr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->capa_refer_ocr) && in_array('1', explode(',', $micro_data->capa_refer_ocr[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->capa_refer_ocr) && in_array('2', explode(',', $micro_data->capa_refer_ocr[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments">Required Action Plan? </label>
                            <select name="required_action_plan_ocr">
                               <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->required_action_plan_ocr == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->required_action_plan_ocr == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Required Action Task?</label>
                            <select name="required_action_task_ocr">
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->required_action_task_ocr == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->required_action_task_ocr == 'yes') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Reference.</label>
                            <select multiple id="reference_record" name="action_task_reference_ocr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->action_task_reference_ocr) && in_array('1', explode(',', $micro_data->action_task_reference_ocr[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->action_task_reference_ocr) && in_array('2', explode(',', $micro_data->action_task_reference_ocr[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Risk Assessment Req?</label>
                            <select name="risk_assessment_req_ocr">
                               <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->risk_assessment_req_ocr == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->risk_assessment_req_ocr == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Risk Assessment Ref.</label>
                            <select multiple id="reference_record" name="risk_assessment_ref_ocr[]" id="">
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->risk_assessment_ref_ocr) && in_array('1', explode(',', $micro_data->risk_assessment_ref_ocr[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->risk_assessment_ref_ocr) && in_array('2', explode(',', $micro_data->risk_assessment_ref_ocr[0]))) ? 'selected' : '' }}>2</option>
                             </select>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Justify if No Risk Assessment</label>
                            <textarea class="summernote" name="justify_if_no_risk_assessment_ocr" id="summernote-1">{{ $micro_data->justify_if_no_risk_assessment_ocr }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Conclusion Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="conclusion_attachment_ocr">
                                    @if ($micro_data->conclusion_attachment_ocr)
                                    @foreach ($micro_data->conclusion_attachment_ocr as $file)
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
                            <input type="text" name="qa_approver_ocr" value="{{ $micro_data->qa_approver_ocr }}">
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
<!--CQ Review Comments -->
<div id="CCForm10" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">CQ Review Comments</div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">CQ Review comments</label>
                    <textarea class="summernote" name="cq_review_comments_OOS_CQ" id="summernote-1">{{ $micro_data->cq_review_comments_OOS_CQ }}
                            </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments"> CAPA Required ?</label>
                    <select name="capa_required_OOS_CQ">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->capa_required_OOS_CQ == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->capa_required_OOS_CQ == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Reference of CAPA </label>
                    <input type="num" name="reference_of_capa_OOS_CQ" value="{{ $micro_data->reference_of_capa_OOS_CQ }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Auditee"> Action plan requirement ? </label>
                    <select name="action_plan_requirement_OOS_CQ" 
                        data-search="false" data-silent-initial-value-set="true" id="auditee">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->action_plan_requirement_OOS_CQ == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->action_plan_requirement_OOS_CQ == 'no') selected @endif>No</option>
                   </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Ref Action Plan </label>
                    <input type="text" name="ref_action_plan_OOS_CQ" value="{{ $micro_data->ref_action_plan_OOS_CQ }}">
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Attachments"> CQ Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="cq_attachment_OOS_CQ">
                            @if ($micro_data->cq_attachment_OOS_CQ)
                            @foreach ($micro_data->cq_attachment_OOS_CQ as $file)
                                <h6 type="button" class="file-container text-dark" style="background-color: rgb(243, 242, 240);">
                                    <b>{{ $file }}</b>
                                    <a href="{{ asset('upload/' . $file) }}" target="_blank">
                                        <i class="fa fa-eye text-primary" style="font-size:20px; margin-right:-10px;"></i>
                                    </a>
                                    <a type="button" class="remove-file" data-file-name="{{ $file }}">
                                       <i class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i>
                                    </a>
                                </h6>
                            @endforeach
                            @endif
                        </div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="cq_attachment_OOS_CQ[]"
                                oninput="addMultipleFiles(this, 'cq_attachment_OOS_CQ')" multiple>
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