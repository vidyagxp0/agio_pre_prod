<div id="CCForm8" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Conclusion Comments
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="conclusion_comments_oosc" id="summernote-1">
                        {{ $data->conclusion_comments_oosc ?? '' }}
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
                            </tr>
                        </thead>
                        <tbody>
                            @if ($oos_conclusions)
                                @foreach ($oos_conclusions->data as $oos_conclusion)
                                    <tr>
                                        <td><input disabled type="text" name="oos_conclusion[{{$loop->index }}][serial]" value="{{$loop->index + 1 }}"></td>
                                        <td><input type="text" name="oos_conclusion[{{$loop->index }}][summary_results_analysis_detials]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analysis_detials') }}"></td>
                                        <td><input type="text" name="oos_conclusion[{{$loop->index }}][summary_results_hypothesis_experimentation_test_pr_no]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_hypothesis_experimentation_test_pr_no') }}"></td>
                                        <td><input type="text" name="oos_conclusion[{{$loop->index }}][summary_results]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results') }}"></td>
                                        <td><input type="text" name="oos_conclusion[{{$loop->index }}][summary_results_analyst_name]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_analyst_name') }}"></td>
                                        <td><input type="text" name="oos_conclusion[{{$loop->index }}][summary_results_remarks]" value="{{ Helpers::getArrayKey($oos_conclusion, 'summary_results_remarks') }}"></td> 
                                    </tr>  
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>



            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments">Specification Limit </label>
                    <input type="text" value="{{$data->specification_limit_oosc}}" name="specification_limit_oosc">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">Results to be Reported</label>
                    <select name="results_to_be_reported_oosc">
                        <option value="Initial" {{ $data->results_to_be_reported_oosc == 'Initial' ? 'selected' : ''
                            }}>Initial</option>
                        <option value="Retested_result" {{ $data->results_to_be_reported_oosc == 'Retested_result' ?
                            'selected' : '' }}>Retested Result</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Final Reportable Results</label>
                    <input type="text" name="final_reportable_results_oosc"
                        value="{{ $data->final_reportable_results_oosc ?? '' }}">
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justifi. for Averaging Results</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="justifi_for_averaging_results_oosc" id="summernote-1">
                                {{ $data->justifi_for_averaging_results_oosc ?? '' }}
                            </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">OOS Stands </label>
                    <select name="oos_stands_oosc">
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
                    <select name="capa_req_oosc">
                        <option value="Yes" {{ $data->capa_req_oosc == 'Yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $data->capa_req_oosc == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">CAPA Ref No.</label>
                    <select multiple id="reference_record" name="capa_ref_no_oosc[]">
                        <option value="0">--Select---</option>
                        {{-- {{ in_array('0', $data->capa_ref_no_oosc ?? []) ? 'selected' : '' }} --}}
                        
                        <option value="1">1
                        </option>

                        <option value="2">2
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if CAPA not required</label>
                    <textarea class="summernote" name="justify_if_capa_not_required_oosc" id="summernote-1">
                                {{ $data->justify_if_capa_not_required_oosc ?? '' }}
                            </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">Action Item Req.</label>
                    <select name="action_plan_req_oosc">
                        <option value="Yes" {{ $data->action_plan_req_oosc == 'Yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ $data->action_plan_req_oosc == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Action Item Ref.</label>
                    <select multiple id="reference_record" name="action_plan_ref_oosc[]">
                        <option value="0" {{ in_array('0', $data->action_plan_ref_oosc ?? []) ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="1" {{ in_array('1', $data->action_plan_ref_oosc ?? []) ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ in_array('2', $data->action_plan_ref_oosc ?? []) ? 'selected' : '' }}>2
                        </option>
                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justification for Delay</label>
                    <textarea class="summernote" name="justification_for_delay_oosc" id="summernote-1">
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
                        <div class="file-attachment-list" id="file_attach">
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
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                        </div>
                    </div>

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