<div id="CCForm14" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Addendum Execution Comment
        </div>
        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Execution Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="execution_comments_uae" id="summernote-1">

                                {{ $data->execution_comments_uae ?? '' }}
                                </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Action Task Required?</label>
                    <select name="action_task_required_uae">
                        <option value="0" {{ $data->action_task_required_uae == '0' ? 'selected' : '' }}>Enter Your
                            Selection Here</option>
                        <option value="yes" {{ $data->action_task_required_uae == 'yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ $data->action_task_required_uae == 'No' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
            </div>

            <!-- Action Task Reference No. -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Action Task Reference No.</label>
                    <select multiple id="reference_record" name="action_task_reference_no_uae[]">
                        <option value="0" {{ in_array('0', $data->action_task_reference_no_uae ?? []) ? 'selected' :
                            '' }}>--Select---</option>
                        <option value="1" {{ in_array('1', $data->action_task_reference_no_uae ?? []) ? 'selected' :
                            '' }}>1</option>
                        <option value="2" {{ in_array('2', $data->action_task_reference_no_uae ?? []) ? 'selected' :
                            '' }}>2</option>
                    </select>
                </div>
            </div>
            <!-- Additional Testing Required? -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Addi.Testing Req?</label>
                    <select name="addi_testing_req_uae">
                        <option value="0" {{ $data->addi_testing_req_uae == '0' ? 'selected' : '' }}>Enter Your
                            Selection Here</option>
                        <option value="yes" {{ $data->addi_testing_req_uae == 'yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ $data->addi_testing_req_uae == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <!-- Additional Testing Reference -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Addi.Testing Ref.</label>
                    <select multiple id="reference_record" name="Addi_testing_ref_uae[]">
                        <option value="0" {{ in_array('0', $data->Addi_testing_ref_uae ?? []) ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="1" {{ in_array('1', $data->Addi_testing_ref_uae ?? []) ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ in_array('2', $data->Addi_testing_ref_uae ?? []) ? 'selected' : '' }}>2
                        </option>
                    </select>
                </div>
            </div>

            <!-- Investigation Required? -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Investigation Req.?</label>
                    <select name="investigation_req_uae">
                        <option value="0" {{ $data->investigation_req_uae == '0' ? 'selected' : '' }}>Enter Your
                            Selection Here</option>
                        <option value="yes" {{ $data->investigation_req_uae == 'yes' ? 'selected' : '' }}>Yes
                        </option>
                        <option value="No" {{ $data->investigation_req_uae == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Investigation Ref.</label>
                    <select multiple id="reference_record" name="investigation_ref_uae[]" id="">
                        <option value="0" {{ in_array('0', $data->investigation_ref_uae ?? []) ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="1" {{ in_array('1', $data->investigation_ref_uae ?? []) ? 'selected' : ''
                            }}>1</option>
                        <option value="2" {{ in_array('2', $data->investigation_ref_uae ?? []) ? 'selected' : ''
                            }}>2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Hypo-Exp Req?</label>
                    <select name="hypo_exp_req_uae">
                        <option value="0" {{ $data->hypo_exp_req_uae == '0' ? 'selected' : '' }}>Enter Your
                            Selection Here</option>
                        <option value="yes" {{ $data->hypo_exp_req_uae == 'yes' ? 'selected' : '' }}>Yes</option>
                        <option value="No" {{ $data->hypo_exp_req_uae == 'No' ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>

            <!-- Hypo-Exp Ref. -->
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Records">Hypo-Exp Ref.</label>
                    <select multiple id="reference_record" name="hypo_exp_ref_uae[]">
                        <option value="0" {{ in_array('0', $data->hypo_exp_ref_uae ?? []) ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="1" {{ in_array('1', $data->hypo_exp_ref_uae ?? []) ? 'selected' : '' }}>1
                        </option>
                        <option value="2" {{ in_array('2', $data->hypo_exp_ref_uae ?? []) ? 'selected' : '' }}>2
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Addendum Attachments
                    </label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach">
                            @if ($data->addendum_attachments_uae)
                            @foreach ($data->addendum_attachments_uae as $file)
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
                            <input type="file" id="myfile" name="addendum_attachments_uae[]"
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