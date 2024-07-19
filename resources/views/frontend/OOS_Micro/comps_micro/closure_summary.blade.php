<div id="CCForm12" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head"> Batch Disposition </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">OOS Category</label>
                    <select name="oos_category_BI" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="analyst-error" @if ($micro_data->oos_category_BI == 'analyst-error') selected @endif>Analyst Error</option>
                        <option value="instrument-error" @if ($micro_data->oos_category_BI == 'instrument-error') selected @endif>Instrument Error</option>
                        <option value="procedure-error" @if ($micro_data->oos_category_BI == 'procedure-error') selected @endif>Procedure Error</option>
                        <option value="product-related-error" @if ($micro_data->oos_category_BI == 'product-related-error') selected @endif>Product Related Error</option>
                        <option value="material-related-error" @if ($micro_data->oos_category_BI == 'material-related-error') selected @endif>Material Related Error</option>
                        <option value="other-error" @if ($micro_data->oos_category_BI == 'other-error') selected @endif>Other Error</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Other's</label>
                    <input type="string" name="others_BI" value="{{ $micro_data->others_BI }}" {{Helpers::isOOSMicro($micro_data->stage)}}>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Material/Batch Release</label>
                    <select name="material_batch_release_BI" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="to-be-release" @if ($micro_data->material_batch_release_BI == 'to-be-release') selected @endif>To Be Release</option>
                        <option value="to-be-rejected" @if ($micro_data->material_batch_release_BI == 'to-be-rejected') selected @endif>To Be Rejected</option>
                        <option value="other-action" @if ($micro_data->material_batch_release_BI == 'other-action') selected @endif>Other Action (Specify)</option>

                    </select>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Other Action (Specify)</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="other_action_BI" id="summernote-1"
                    >{{ $micro_data->other_action_BI }}
                            </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Field alert reference</label>
                    <select multiple id="reference_record" name="field_alert_reference_BI[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">--Select---</option>
                        <option value="1" {{ (!empty($micro_data->field_alert_reference_BI) && in_array('1', explode(',', $micro_data->field_alert_reference_BI[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->field_alert_reference_BI) && in_array('2', explode(',', $micro_data->field_alert_reference_BI[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>
            <div class="sub-head">Assessment for batch disposition</div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Other Parameters Results</label>
                    <textarea class="summernote" name="other_parameter_result_BI" id="summernote-1">{{ $micro_data->other_parameter_result_BI }}
                    </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Trend of Previous Batches</label>
                    <textarea class="summernote" name="trend_of_previous_batches_BI" id="summernote-1">{{ $micro_data->trend_of_previous_batches_BI }}
                    </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Stability Data</label>
                    <textarea class="summernote" name="stability_data_BI" id="summernote-1">{{ $micro_data->other_parameter_result_BI }}
                    </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Process Validation Data</label>
                    <textarea class="summernote" name="process_validation_data_BI" id="summernote-1">{{ $micro_data->process_validation_data_BI }}
                        </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Method Validation </label>
                    <textarea class="summernote" name="method_validation_BI" id="summernote-1">{{ $micro_data->method_validation_BI }}
                    </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Any Market Complaints </label>
                    <textarea class="summernote" name="any_market_complaints_BI" id="summernote-1">{{ $micro_data->any_market_complaints_BI }}
                    </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Statistical Evaluation </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="statistical_evaluation_BI" id="summernote-1">
                        {{ $micro_data->statistical_evaluation_BI }}</textarea>
                </div>

            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Risk Analysis for Disposition </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="risk_analysis_for_disposition_BI" id="summernote-1">
                        {{ $micro_data->risk_analysis_for_disposition_BI }}</textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="conclusion_BI" id="summernote-1">
                        {{ $micro_data->conclusion_BI }}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Phase-III Inves. Required?</label>
                    <select name="phase_III_inves_required_BI" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option>Enter Your Selection Here</option>
                        <option value="1" {{ (!empty($micro_data->phase_III_inves_required_BI) && in_array('1', explode(',', $micro_data->phase_III_inves_required_BI[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->phase_III_inves_required_BI) && in_array('2', explode(',', $micro_data->phase_III_inves_required_BI[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Phase-III Inves. Reference</label>
                    <select multiple id="reference_record" name="phase_III_inves_reference_BI[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">--Select---</option>
                        <option value="1" {{ (!empty($micro_data->phase_III_inves_reference_BI) && in_array('1', explode(',', $micro_data->phase_III_inves_reference_BI[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->phase_III_inves_reference_BI) && in_array('2', explode(',', $micro_data->phase_III_inves_reference_BI[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify for Delay in Activity</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="justify_for_delay_BI" id="summernote-1"
                     {{Helpers::isOOSMicro($micro_data->stage)}}>
                        {{ $micro_data->justify_for_delay_BI }}</textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Closure Summary</label>
                    <textarea class="summernote" name="reopen_request" id="summernote-1">
                    {{ $micro_data->reopen_request }}    </textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Disposition Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="disposition_attachment_BI">
                            @if ($micro_data->disposition_attachment_BI)
                            @foreach ($micro_data->disposition_attachment_BI as $file)
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
                            <input type="file" id="myfile" name="disposition_attachment_BI[]" oninput="addMultipleFiles(this, 'disposition_attachment_BI')"
                             multiple {{Helpers::isOOSMicro($micro_data->stage)}}>
                        </div>
                    </div>

                </div>
            </div>
            <div class="button-block">
            @if ($micro_data->stage == 0  || $micro_data->stage >= 14)
                <div class="progress-bars">
                        <div class="bg-danger">Workflow is already Closed-Done</div>
                    </div>
            @else
            <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            <button type="button" id="ChangeNextButton" class="nextButton"
                onclick="nextStep()">Next</button>
            @endif
                <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                        Exit </a> </button>
            </div>
        </div>
    </div>
</div>