<div id="CCForm7" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Additional Testing Proposal by QA
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Review Comment</label>
                            <textarea class="summernote" name="review_comment_atp" id="summernote-1" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->review_comment_atp }}
                            </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Report Attachments"> Additional Test Proposal </label>
                            <select name="additional_test_proposal_atp" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->additional_test_proposal_atp == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->additional_test_proposal_atp == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Additional Test Reference.
                            </label>
                            <select multiple id="reference_record" name="additional_test_reference_atp[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->additional_test_reference_atp) && in_array('1', explode(',', $micro_data->additional_test_reference_atp[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->additional_test_reference_atp) && in_array('2', explode(',', $micro_data->additional_test_reference_atp[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments"> Any Other Actions Required</label>
                            <select name="any_other_actions_required_atp" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->any_other_actions_required_atp == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->any_other_actions_required_atp == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Reference</label>
                            <select multiple id="reference_record" name="action_task_reference_atp[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->action_task_reference_atp) && in_array('1', explode(',', $micro_data->action_task_reference_atp[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->action_task_reference_atp) && in_array('2', explode(',', $micro_data->action_task_reference_atp[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Additional Testing Attachment </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="additional_testing_attachment_atp">
                                    @if ($micro_data->additional_testing_attachment_atp)
                                    @foreach ($micro_data->additional_testing_attachment_atp as $file)
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
                                    <input type="file" id="myfile" name="additional_testing_attachment_atp[]"
                                        oninput="addMultipleFiles(this, 'additional_testing_attachment_atp')" multiple
                                        {{Helpers::isOOSMicro($micro_data->stage)}}>
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