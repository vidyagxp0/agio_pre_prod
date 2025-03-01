<div id="CCForm13" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
             Phase II B QAH/CQAH
        </div>
        <div class="row">
       
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation"> Approval Comments<span class="text-danger">*</span> </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="reopen_approval_comments_uaa" id="summernote-1">
                                {{ $data->reopen_approval_comments_uaa ?? '' }}
                                </textarea>
                </div>
            </div>

            {{-- <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Approval Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="addendum_attachment_uaa">

                            @if ($data->addendum_attachment_uaa)
                            @foreach ($data->addendum_attachment_uaa as $file)
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
                            <input type="file" id="myfile" name="addendum_attachment_uaa[]"
                                oninput="addMultipleFiles(this, 'addendum_attachment_uaa')" {{ $data->stage == 20 ? '' : 'disabled' }} multiple>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="sub-head">
            Batch Disposition
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments">OOS Category</label>
                    <select name="oos_category_bd" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 20 ? '' : 'disabled' }}>
                        <option value="" >Enter Your Selection Here</option>
                        <option value="analyst_error" {{ $data->oos_category_bd == 'analyst_error' ? 'selected' : ''
                            }}>Analyst Error</option>
                        <option value="instrument_error" {{ $data->oos_category_bd == 'instrument_error' ?
                            'selected' : '' }}>Instrument Error</option>
                        <option value="procedure_error" {{ $data->oos_category_bd == 'procedure_error' ? 'selected'
                            : '' }}>Procedure Error</option>
                        <option value="product_related_error" {{ $data->oos_category_bd == 'product_related_error' ?
                            'selected' : '' }}>Product Related Error</option>
                        <option value="material_related_error" {{ $data->oos_category_bd == 'material_related_error'
                            ? 'selected' : '' }}>Material Related Error</option>
                        <option value="other_error" {{ $data->oos_category_bd == 'other_error' ? 'selected' : ''
                            }}>Other Error</option>
                    </select>
                </div>
            </div>

            <!-- Others Field -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Other's</label>
                    <input type="text" name="others_bd" value="{{ $data->others_bd ?? '' }}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 20 ? '' : 'readonly' }}>
                </div>
            </div>
            <!-- Material/Batch Release Selection -->
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Records">Material/Batch Release</label>
                    <select name="material_batch_release_bd" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 20 ? '' : 'disabled' }}>
                        <option value="" {{ $data->material_batch_release_bd == '' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="To Be Released" {{ $data->material_batch_release_bd == 'To Be Released' ? 'selected' : ''
                            }}>To Be Released</option>
                        <option value="To Be Rejected" {{ $data->material_batch_release_bd == 'To Be Rejected' ? 'selected' : ''
                            }}>To Be Rejected</option>
                        <option value="other" {{ $data->material_batch_release_bd == 'other' ? 'selected' : ''
                            }}>Other Action (Specify)</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Other Action (Specify)</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="other_action_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                            {{$data->other_action_bd ??  ''}}
                                </textarea>
                </div>
            </div>
            <!-- Other Parameters Results -->
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Other Parameters Results</label>
                    <textarea class="summernote" name="other_parameters_results_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                            {{ $data->other_parameters_results_bd ?? '' }}
                        </textarea>
                </div>
            </div>

            <!-- Trend of Previous Batches -->
            {{-- <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Trend of Previous Batches</label>
                    <textarea class="summernote" name="trend_of_previous_batches_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                            {{ $data->trend_of_previous_batches_bd ?? '' }}
                        </textarea>
                </div>
            </div>

            <!-- Stability Data -->
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Stability Data</label>
                    <textarea class="summernote" name="stability_data_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                            {{ $data->stability_data_bd ?? '' }}
                        </textarea>
                </div>
            </div>

            <!-- Process Validation Data -->
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Process Validation Data</label>
                    <textarea class="summernote" name="process_validation_data_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                            {{ $data->process_validation_data_bd ?? '' }}
                        </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Method Validation </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="method_validation_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                                        {{ $data->method_validation_bd ?? '' }}
                                </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Any Market Complaints </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="any_market_complaints_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                                {{ $data->any_market_complaints_bd ?? '' }}
                                </textarea>
                </div>

            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Statistical Evaluation </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="statistical_evaluation_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                        {{ $data->statistical_evaluation_bd ?? '' }}
                        </textarea>
                </div>

            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Risk Analysis for Disposition </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="risk_analysis_disposition_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                                {{ $data->risk_analysis_disposition_bd ?? '' }}
                                </textarea>
                </div>

            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Conclusion </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="conclusion_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                                    {{ $data->conclusion_bd ?? '' }}
                                </textarea>
                </div>

            </div> --}}
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify For Delay In Activity</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="justify_for_delay_in_activity_bd" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                                    {{ $data->justify_for_delay_in_activity_bd ?? '' }}
                                </textarea>
                </div>

            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Disposition Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="disposition_attachment_bd">

                            @if ($data->disposition_attachment_bd)
                            @foreach ($data->disposition_attachment_bd as $file)
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
                            <input type="file" id="myfile" name="disposition_attachment_bd[]"
                                oninput="addMultipleFiles(this, 'disposition_attachment_bd')" {{ $data->stage == 20 ? '' : 'readonly' }} multiple {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>

                </div>
            </div>

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