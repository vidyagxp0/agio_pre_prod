<div id="CCForm16" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Addendum Verification Comment
        </div>
        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Verification Comments </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="verification_comments_uav" id="summernote-1">
                                        {{$data->verification_comments_uav ?? 'na'}}
                </textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Verification Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach">
                            @if (!empty($data->verification_attachment_uar))
                          
                             @foreach ($data->verification_attachment_uar as $file) 
                            <h6 type="button" class="file-container text-dark"
                                style="background-color: rgb(243, 242, 240);">
                                <b></b>
                                <a href="{{ asset('upload/') }}" target="_blank"><i
                                        class="fa fa-eye text-primary"
                                        style="font-size:20px; margin-right:-10px;"></i></a>
                                <a type="button" class="remove-file" data-file-name=""><i
                                        class="fa-solid fa-circle-xmark" style="color:red; font-size:20px;"></i></a>
                            </h6>
                         @endforeach 
                            @else
                            <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="verification_attachment_uar[]"
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
                            </div>

                            @endif

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