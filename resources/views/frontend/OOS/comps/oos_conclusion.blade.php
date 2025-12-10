<div id="CCForm8" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            OOS/OOT Conclusion
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion Comments s @if($data->stage == 20) <span class="text-danger">*</span>@endif</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="conclusion_comments_oosc" id="summernote-1"  >
                        {{ $data->conclusion_comments_oosc ?? '' }}
                        </textarea>
                </div>
            </div>


            <!-- ---------------------------grid-1 -------------------------------- -->
            {{-- <div class="group-input">
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
                            @if ($oos_conclusion && is_array($oos_conclusion->data))
                                @foreach ($oos_conclusion->data as $oos_conclusion)
                                    <tr>
                                        <td><input disabled type="text" name="oos_conclusion[{{$loop->index }}][serial]" value="{{$loop->index + 1 }}"></td>
                                        <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion[{{$loop->index }}][summary_results_analysis_detials]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analysis_detials') }}"></td>
                                        <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion[{{$loop->index }}][summary_results_hypothesis_experimentation_test_pr_no]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_hypothesis_experimentation_test_pr_no') }}"></td>
                                        <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion[{{$loop->index }}][summary_results]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results') }}"></td>
                                        <td><input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion[{{$loop->index }}][summary_results_analyst_name]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analyst_name') }}"></td>
                                        <td><input  {{Helpers::isOOSChemical($data->stage)}}  type="text" name="oos_conclusion[{{$loop->index }}][summary_results_remarks]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_remarks') }}"></td> 
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>  
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div> --}}
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments">Specification Limit </label>
                    <input type="text" value="{{$data->specification_limit_oosc}}" name="specification_limit_oosc" {{   $data->stage == 21 ? 'disabled' : '' }}>
                                                                            
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">Results to be Reported</label>
                    <select name="results_to_be_reported_oosc" {{  $data->stage == 21 ? 'disabled' : '' }}>
                       <option value="">Enter Your Selection Here</option>
                        <option value="Initial" {{ $data->results_to_be_reported_oosc == 'Initial' ? 'selected' : ''
                            }}>Initial</option>
                            <option value="Retested result"{{ $data->results_to_be_reported_oosc == 'Retested result' ?
                                'selected' : '' }}>Retested Result</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Final Reportable Results</label>
                    <input type="text" name="final_reportable_results_oosc"
                        value="{{ $data->final_reportable_results_oosc ?? '' }}"  {{  $data->stage == 21 ? 'disabled' : '' }}>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justifi. for Averaging Results s @if($data->stage == 20) <span class="text-danger">*</span>@endif</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="justifi_for_averaging_results_oosc" id="summernote-1"  {{ $data->stage == 21 ? 'disabled' : ''  }}>
                                {{ $data->justifi_for_averaging_results_oosc ?? '' }}
                            </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">OOS/OOT Stands </label>
                    <select name="oos_stands_oosc"  {{  $data->stage == 21 ? 'disabled' : ''}}>
                       <option value="">Enter Your Selection Here</option>
                        <option value="Valid" {{ $data->oos_stands_oosc == 'Valid' ? 'selected' : '' }}>Valid
                        </option>
                        <option value="Invalid" {{ $data->oos_stands_oosc == 'Invalid' ? 'selected' : '' }}>Invalid
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">CAPA Req.</label>
                    <select name="capa_req_oosc"  {{  $data->stage == 21 ? 'disabled' : '' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->capa_req_oosc == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $data->capa_req_oosc == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">CAPA Ref No.</label>
                    <select multiple id="reference_record" name="capa_ref_no_oosc[]" {{  $data->stage == 21 ? 'disabled' : '' }}
                        

                        placeholder="Select Reference Records">
                        
                        @if (!empty($capa_record))
                            @foreach ($capa_record as $new)
                                @php
                                    $recordValue =
                                        Helpers::getDivisionName($new->division_id) .
                                        '/CAPA/' .
                                        date('Y') . 
                                        '/' . 
                                        Helpers::recordFormat($new->record);
            
                                    // Ensure $data->capa_ref_no_oosc is properly fetched from the DB
                                    $selectedValues = is_string($data->capa_ref_no_oosc) 
                                        ? explode(',', $data->capa_ref_no_oosc) 
                                        : (is_array($data->capa_ref_no_oosc) 
                                            ? $data->capa_ref_no_oosc 
                                            : []);
            
                                    // Check if the recordValue exists in the selected values
                                    $selected = in_array($recordValue, $selectedValues) ? 'selected' : '';
                                @endphp
                                <option value="{{ $recordValue }}" {{ $selected }}>
                                    {{ $recordValue }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if CAPA not required</label>
                    <textarea class="summernote" name="justify_if_capa_not_required_oosc" id="summernote-1"  {{ $data->stage == 21 ? 'disabled' : ''  }}>
                                {{ $data->justify_if_capa_not_required_oosc ?? '' }}
                            </textarea>
                </div>
            </div>

            {{-- <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">Action Item Req.</label>
                    <select name="action_plan_req_oosc"  {{Helpers::isOOSChemical($data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->action_plan_req_oosc == 'Yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ $data->action_plan_req_oosc == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
           
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Action Item Ref.</label>
                    <select multiple id="related_records" name="action_plan_ref_oosc[]"
                        placeholder="Select Reference Records">
            
                        @if (!empty($old_record))
                            @foreach ($old_record as $new)
                                @php
                                    $recordValue =
                                        Helpers::getDivisionName($new->division_id) .
                                        '/AI/' .
                                        date('Y') .
                                        '/' .
                                        Helpers::recordFormat($new->record);
            
                                    $selectedValues = is_string($data->action_plan_ref_oosc) 
                                        ? explode(',', $data->action_plan_ref_oosc) 
                                        : (is_array($data->action_plan_ref_oosc) 
                                            ? $data->action_plan_ref_oosc 
                                            : []);
            
                                    $selected = in_array($recordValue, $selectedValues) ? 'selected' : '';
                                @endphp
                                <option value="{{ $recordValue }}" {{ $selected }}>
                                    {{ $recordValue }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            
            
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justification for Delay</label>
                    <textarea class="summernote" name="justification_for_delay_oosc" id="summernote-1"  {{Helpers::isOOSChemical($data->stage)}}>
                                {{ $data->justification_for_delay_oosc ?? '' }}
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
                        <div class="file-attachment-list" id="file_attachments_if_any_ooscattach">
                            @if ($data->file_attachments_if_any_ooscattach)
                            @foreach($data->file_attachments_if_any_ooscattach as $file)
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
                            <input type="file" id="myfile" name="file_attachments_if_any_ooscattach[]"
                                oninput="addMultipleFiles(this, 'file_attachments_if_any_ooscattach')"
                                 multiple  {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>

                </div>
            </div>

            <div class="sub-head">
                Conclusion Review Comments
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion Review Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="conclusion_review_comments_ocr" id="summernote-1" 
                    {{Helpers::isOOSChemical($data->stage)}}>
                        {{ $data->conclusion_review_comments_ocr ? $data->conclusion_review_comments_ocr : '' }}
                    </textarea>
                </div>
            </div>


            <!-- ---------------------------grid-1 ------"OOSConclusion_Review-------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Summary of OOS Test Results
                    <button type="button" name="audit-agenda-grid" id="oos_conclusion_review">+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oos_conclusion_review_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 24%">Material/Product Name</th>
                                <th style="width: 24%">Batch No.(s) / A.R. No. (s)</th>
                                <th style="width: 24%">Any Other Information</th>
                                <th style="width: 24%">Action Taken on Affec.batch</th>
                                <th style="widht: 4%">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($oos_conclusion_review && is_array($oos_conclusion_review->data))
                                @foreach ($oos_conclusion_review->data as $oos_conclusion_review)
                                    <tr>
                                        <td><input disabled type="text" name="oos_conclusion_review[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_product_name]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_product_name') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_batch_no]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_batch_no') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_any_other_information]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_any_other_information') }}"></td>
                                        <td><input {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_conclusion_review[{{ $loop->index }}][conclusion_review_action_affecte_batch]" value="{{ Helpers::getArrayKey($oos_conclusion_review, 'conclusion_review_action_affecte_batch') }}"></td>
                                        <td><button {{Helpers::isOOSChemical($data->stage)}} type="text" class="removeRowBtn">Remove</button></td>
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
                    <textarea class="summernote" name="action_taken_on_affec_batch_ocr" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                    {{ $data->action_taken_on_affec_batch_ocr ? $data->action_taken_on_affec_batch_ocr :'' }}
                </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">CAPA Req?</label>
                    <select name="capa_req_ocr" {{Helpers::isOOSChemical($data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->capa_req_ocr == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $data->capa_req_ocr == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">CAPA Reference</label>
                    <select multiple id="reference_record" name="capa_refer_ocr[]" {{Helpers::isOOSChemical($data->stage)}}>
                    <option value="">Enter Your Selection Here</option>
                    <option value="1" {{ (!empty($data->capa_refer_ocr) && in_array('1', explode(',', $data->capa_refer_ocr[0]))) ? 'selected' : '' }}>1</option>
                    <option value="2" {{ (!empty($data->capa_refer_ocr) && in_array('2', explode(',', $data->capa_refer_ocr[0]))) ? 'selected' : '' }}>2</option>
                  </select>
                 
                </div>
            </div> --}}

            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if No Risk Assessment</label>
                    <textarea class="summernote" name="justify_if_no_risk_assessment_ocr" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                            {{ $data->justify_if_no_risk_assessment_ocr ? $data->justify_if_no_risk_assessment_ocr : '' }}
                        </textarea>
                </div>
            </div> --}}

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Action On affected batches</label>
                    <textarea class="summernote" name="action_on_affected_batch" id="summernote-1" {{ $data->stage == 21 ? 'disabled' : ''  }}>
                            {{ $data->action_on_affected_batch ? $data->action_on_affected_batch : '' }}
                        </textarea>
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="group-input">
                    <label for="Audit Attachments">CQ Approver</label>
                    <input type="text" name="cq_approver" value="{{$data->cq_approver ? $data->cq_approver : '' }}" {{Helpers::isOOSChemical($data->stage)}}>
                </div>
            </div> --}}
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
                                oninput="addMultipleFiles(this, 'conclusion_attachment_ocr')" multiple 
                                {{ in_array($data->stage, [17, 18, 20]) ? 'disabled' : '' }} >
                        </div>
                    </div>
                </div>
            </div>
           
            {{-- <div class="sub-head">
                CQ Review Comments
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">CQ Review comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="cq_review_comments_ocqr" id="summernote-1">
                                {{ $data->cq_review_comments_ocqr ?? '' }} 
                        </textarea>
                </div>
            </div>
            
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Attachments"> CQ Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="cq_attachment_ocqr">

                            @if ($data->cq_attachment_ocqr)
                            @foreach ($data->cq_attachment_ocqr as $file)
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
                            <input type="file" id="myfile" name="cq_attachment_ocqr[]"
                                oninput="addMultipleFiles(this, 'cq_attachment_ocqr')" multiple>
                        </div>
                    </div>

                </div>
            </div> --}}

            <div class="button-block">
                @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)
                
                @else
                <button type="submit" class="saveButton">Save</button>
                <button type="button" class="backButton" onclick="previousStep()">Back</button>
                <button type="button" class="nextButton" onclick="nextStep()">Next</button>
                @endif
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
            </div>

        </div>
    </div>
</div>