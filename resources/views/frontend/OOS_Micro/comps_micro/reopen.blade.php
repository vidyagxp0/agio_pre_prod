<div id="CCForm12" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Reopen Request
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Other Action (Specify)</label>
                    <textarea class="summernote" name="reopen_request" id="summernote-1" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->reopen_request }}
                    </textarea>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Reopen Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="reopen_attachment">
                            @if ($micro_data->reopen_attachment)
                            @foreach ($micro_data->reopen_attachment as $file)
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
                            <input type="file" id="myfile" name="reopen_attachment[]"
                                oninput="addMultipleFiles(this, 'reopen_attachment')" multiple {{Helpers::isOOSMicro($micro_data->stage)}}>
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