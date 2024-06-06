<div id="CCForm7" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Additional Testing Proposal by QA
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Review Comment</label>
                     <textarea class="summernote" name="review_comment_atp" id="summernote-1">
                      {{ $data->review_comment_atp ? $data->review_comment_atp : ''}}
                     </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments"> Additional Test Proposal </label>
                    <select name="additional_test_proposal_atp">
                        <option value="0" {{ $data->additional_test_proposal_atp == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->additional_test_proposal_atp == 'Yes' ? 'selected' :
                            '' }}>Yes</option>
                        <option value="No" {{ $data->additional_test_proposal_atp == 'No' ? 'selected' : ''
                            }}>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Reference Records">Additional Test Comment.</label>
                    
                    <textarea class="summernote" name="additional_test_reference_atp" id="summernote-1">
                        {{ $data->additional_test_reference_atp ? $data->additional_test_reference_atp : '' }}
                    </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Any Other Actions Required</label>
                    <select name="any_other_actions_required_atp">
                        <option value="Yes" {{ $data->any_other_actions_required_atp == 'Yes' ? 'selected' :
                            '' }}>Yes</option>
                        <option value="No" {{ $data->any_other_actions_required_atp == 'No' ? 'selected' :
                            '' }}>No</option>
                    </select>
                </div>
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

                        @if ($data->additional_testing_attachment_atp)
                        @foreach($data->additional_testing_attachment_atp as $file)
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
                        <input type="file" id="myfile" name="additional_testing_attachment_atp[]"
                            oninput="addMultipleFiles(this, 'additional_testing_attachment_atp')" multiple>
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