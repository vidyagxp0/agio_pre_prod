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
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Schedule End Date"> Field Alert Required</label>
                    <select name="field_alert_required">
                        <option value="0" {{ $data->field_alert_required == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->field_alert_required == 'yes' ? 'selected' : ''
                            }}>Yes</option>
                        <option value="no" {{ $data->field_alert_required == 'no' ? 'selected' : ''
                            }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Field Alert Ref.No.
                    </label>
                    <select multiple id="reference_record" name="field_alert_ref_no_pli" id="">
                        <option value="0" {{ $data->field_alert_ref_no_pli == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="1" {{ $data->field_alert_ref_no_pli == 'yes' ? 'selected' : ''
                            }}>1</option>
                        <option value="2" {{ $data->field_alert_ref_no_pli == 'no' ? 'selected' : ''
                            }}>2</option>
                    </select>
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
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name"> Verification Analysis Required</label>
                    <select name="verification_analysis_required_pli">
                        <option value="0" {{ $data->verification_analysis_required_pli == '0' ?
                            'selected' : '' }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->verification_analysis_required_pli == 'yes' ?
                            'selected' : '' }}>yes</option>
                        <option value="no" {{ $data->verification_analysis_required_pli == 'no' ?
                            'selected' : '' }}>no</option>

                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Verification Analysis Ref.</label>
                    <select multiple id="reference_record" name="verification_analysis_ref_pli[]" id="">
                        <option value="0" {{ $data->verification_analysis_ref_pli == '0' ? 'selected' :
                            '' }}>Enter Your Selection Here</option>
                        <option value="1" {{ $data->verification_analysis_ref_pli == '1' ? 'selected' :
                            '' }}>1</option>
                        <option value="2" {{ $data->verification_analysis_ref_pli == '2' ? 'selected' :
                            '' }}>2</option>

                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">Analyst Interview Req.</label>
                    <select name="analyst_interview_req_pli">
                        <option value="0" {{ $data->analyst_interview_req_pli == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->analyst_interview_req_pli == 'yes' ? 'selected' :
                            '' }}>yes</option>
                        <option value="no" {{ $data->analyst_interview_req_pli == 'no' ? 'selected' : ''
                            }}>no</option>

                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Analyst Interview Ref.</label>
                    <select multiple id="reference_record" name="analyst_interview_ref_pli[]" id="">
                        <option value="0" {{ $data->analyst_interview_ref_pli == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="1" {{ $data->analyst_interview_ref_pli == '1' ? 'selected' : ''
                            }}>1</option>
                        <option value="2" {{ $data->analyst_interview_ref_pli == '2' ? 'selected' : ''
                            }}>2</option>

                    </select>
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
                    <label for="Product/Material Name">Phase I Investigation Required</label>
                    <select name="phase_i_investigation_required_pli">
                        <option value="0" {{ $data->phase_i_investigation_required_pli == '0' ?
                            'selected' : '' }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->phase_i_investigation_required_pli == 'yes' ?
                            'selected' : '' }}>yes</option>
                        <option value="no" {{ $data->phase_i_investigation_required_pli == 'no' ?
                            'selected' : '' }}>no</option>

                    </select>
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
                    <label for="Reference Recores">Phase I Investigation Ref.</label>
                    <select multiple id="reference_record" name="phase_i_investigation_ref_pli">
                        <option value="0" {{ $data->phase_i_investigation_ref_pli == 0 ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="1" {{ $data->phase_i_investigation_ref_pli == 1 ? 'selected' : ''
                            }}>1</option>
                        <option value="2" {{ $data->phase_i_investigation_ref_pli == 2 ? 'selected' : ''
                            }}>2</option>
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
                        <div class="file-attachment-list" id="">
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
                            <input type="file" id="myfile" name="file_attachments_pli[]" oninput=""
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