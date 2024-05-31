<div id="CCForm2" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Preliminary Lab. Investigation </div>
        <div class="row">

            <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date"> Comments </label>
                    <div class="col-md-12 4">
                        <div class="group-input">
                            <textarea class="summernote" name="Comments_plidata" value=""
                                id="summernote-1">{{ $data->Comments_plidata ? $data->Comments_plidata : '' }}</textarea>
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
          

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Justify if no Field Alert</label>

                    <textarea class="summernote" name="justify_if_no_field_alert_pli" value=""
                        id="summernote-1">
              {{ $data->justify_if_no_field_alert_pli ? $data->justify_if_no_field_alert_pli : '' }} </textarea>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="group-input">
                    <label for="Audit Schedule Start Date">Justify if no Analyst Int. </label>

                    <!-- <label for="Description Deviation">Description of Deviation</label> -->
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="justify_if_no_analyst_int_pli" value=""
                        id="summernote-1">
                  {{$data && $data->justify_if_no_analyst_int_pli ? $data->justify_if_no_analyst_int_pli : ''}}  </textarea>

                </div>
            </div>
           
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">Phase I Investigation</label>
                    <select name="phase_i_investigation_pli">
                        <option value="0">Enter Your Selection Here</option>
                        <option value="phase_i_micro" {{ $data->phase_i_investigation_pli ==
                            'phase_i_micro' ? 'selected' : '' }}>Phase I Micro</option>
                        <option value="phase_i_chemical" {{ $data->phase_i_investigation_pli ==
                            'phase_i_chemical' ? 'selected' : '' }}>Phase I Chemical</option>
                        <option value="hypothesis" {{ $data->phase_i_investigation_pli == 'hypothesis' ?
                            'selected' : '' }}>Hypothesis</option>
                        <option value="resampling" {{ $data->phase_i_investigation_pli == 'resampling' ?
                            'selected' : '' }}>Resampling</option>
                        <option value="others" {{ $data->phase_i_investigation_pli == 'others' ?
                            'selected' : '' }}>Others</option>
                    </select>
                </div>
            </div>
           
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Initiator Group">File Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>

                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachments_pli">
                            @if ($data->file_attachments_pli)
                            @foreach ($data->file_attachments_pli as $file)
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
                            <input type="file" id="myfile" name="file_attachments_pli[]" 
                            oninput="addMultipleFiles(this, 'file_attachments_pli')"
                                multiple>
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