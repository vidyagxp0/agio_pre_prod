 <!-- Preliminary Lab. Investigation -->
 <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">Preliminary Lab. Investigation </div>
                    <div class="row">

                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date"> Comments </label>
                                <div class="col-md-12 4">
                                    <div class="group-input">
                                        <!-- <label for="Description Deviation">Description of Deviation</label> -->
                                        <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                        <textarea class="summernote" name="comments_pli" id="summernote-1">{{ $micro_data->comments_pli }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Schedule End Date"> Field Alert Required</label>
                                <select name="field_alert_required_pli">
                                    <option>Enter Your Selection Here</option>
                                    <option value="yes" @if ($micro_data->field_alert_required_pli == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($micro_data->field_alert_required_pli == 'no') selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Records">Field Alert Ref.No.</label>
                                <select multiple id="reference_record" name="field_alert_ref_no_pli[]">
                                    <option value="1" {{ (!empty($micro_data->field_alert_ref_no_pli) && in_array('1', explode(',', $micro_data->field_alert_ref_no_pli[0]))) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (!empty($micro_data->field_alert_ref_no_pli) && in_array('2', explode(',', $micro_data->field_alert_ref_no_pli[0]))) ? 'selected' : '' }}>2</option>    
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="group-input">
                                <label for="Description Deviation">Justify if no Field Alert</label>
                                <textarea class="summernote" name="justify_if_no_field_alert_pli" id="summernote-1">{{ $micro_data->justify_if_no_field_alert_pli }}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name"> Verification Analysis Required</label>
                                <select name="verification_analysis_required_pli">
                                    <option>Enter Your Selection Here</option>
                                    <option value="yes" @if ($micro_data->verification_analysis_required_pli == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($micro_data->verification_analysis_required_pli == 'no') selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Verification Analysis Ref.</label>
                                <select multiple id="reference_record" name="verification_analysis_ref_pli[]" id="">
                                    <option value="1" {{ (!empty($micro_data->verification_analysis_ref_pli) && in_array('1', explode(',', $micro_data->verification_analysis_ref_pli[0]))) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (!empty($micro_data->verification_analysis_ref_pli) && in_array('2', explode(',', $micro_data->verification_analysis_ref_pli[0]))) ? 'selected' : '' }}>2</option>    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">Analyst Interview Req.</label>
                                <select name="analyst_interview_req_pli">
                                    <option>Enter Your Selection Here</option>
                                    <option value="yes" @if ($micro_data->analyst_interview_req_pli == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($micro_data->analyst_interview_req_pli == 'no') selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Analyst Interview Ref.</label>
                                <select multiple id="reference_record" name="analyst_interview_ref_pli[]">
                                    <option value="">--Select---</option>
                                    <option value="1" {{ (!empty($micro_data->analyst_interview_ref_pli) && in_array('1', explode(',', $micro_data->analyst_interview_ref_pli[0]))) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (!empty($micro_data->analyst_interview_ref_pli) && in_array('2', explode(',', $micro_data->analyst_interview_ref_pli[0]))) ? 'selected' : '' }}>2</option>    
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-4">
                            <div class="group-input">
                                <label for="Audit Schedule Start Date">Justify if no Analyst Int. </label>

                                <!-- <label for="Description Deviation">Description of Deviation</label> -->
                                <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                                <textarea class="summernote" name="justify_if_no_analyst_int_pli" id="summernote-1">{{ $micro_data->justify_if_no_analyst_int_pli }}
                                    </textarea>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">Phase I Investigation Required</label>
                                <select name="phase_i_investigation_required_pli">
                                    <option>Enter Your Selection Here</option>
                                    <option value="yes" @if ($micro_data->phase_i_investigation_required_pli == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if ($micro_data->phase_i_investigation_required_pli == 'no') selected @endif>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product/Material Name">Phase I Investigation</label>
                                <select name="phase_i_investigation_pli">
                                    <option value="">Enter Your Selection Here</option>
                                    <option value="phase-I-micro" @if ($micro_data->phase_i_investigation_pli == 'phase-I-micro') selected @endif>Phase I Micro</option>
                                    <option value="phase-I-chemical" @if ($micro_data->phase_i_investigation_pli == 'phase-I-chemical') selected @endif>Phase I Chemical</option>
                                    <option value="hypothesis" @if ($micro_data->phase_i_investigation_pli == 'hypothesis') selected @endif>Hypothesis</option>
                                    <option value="resampling" @if ($micro_data->phase_i_investigation_pli == 'resampling') selected @endif>Resampling</option>
                                    <option value="other" @if ($micro_data->phase_i_investigation_pli == 'other') selected @endif>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Recores">Phase I Investigation Ref.</label>
                                <select multiple id="reference_record" name="phase_i_investigation_ref_pli[]" id="">
                                    <option value="">--Select---</option>
                                    <option value="1" {{ (!empty($micro_data->phase_i_investigation_ref_pli) && in_array('1', explode(',', $micro_data->phase_i_investigation_ref_pli[0]))) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (!empty($micro_data->phase_i_investigation_ref_pli) && in_array('2', explode(',', $micro_data->phase_i_investigation_ref_pli[0]))) ? 'selected' : '' }}>2</option>    
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Attachments">File Attachments</label>
                                <small class="text-primary">
                                    Please Attach all relevant or supporting documents
                                </small>
                                <div class="file-attachment-field">
                                    <div class="file-attachment-list" id="file_attach">
                                        @if ($micro_data->file_attachments_pli)
                                        @foreach ($micro_data->file_attachments_pli as $file)
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
                                        <input type="file" id="myfile" name="file_attachments_pli[]"
                                            oninput="addMultipleFiles(this, 'file_attach')" multiple>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">

                                <label style="font-weight: bold; for="Audit Attachments">PHASE- I B INVESTIGATION REPORT</label>


                                @php
                                $phase_I_investigations = [
                                        "Aliquot and standard solutions preserved.",
                                        "Visual examination (solid and solution) reveals normal or abnormal appearance.",
                                        "The analyst is trained on the method.",
                                        "Correct test procedure followed e.g. Current Version of standard testing procedure has been used in testing.",
                                        "Current Validated analytical Method has been used and the data of analytical method validation has been reviewed and found satisfactory.",
                                        "Correct sample(s) tested.",
                                        "Sample Integrity maintained, correct container is used in testing.",
                                        "Assessment of the possibility that the sample contamination (sample left open to air or unattended) has occurred during the testing/ re-testing procedure.",
                                        "All equipment used in the testing is within calibration due period.",
                                        "Equipment log book has been reviewed and no any failure or malfunction has been reviewed.",
                                        "Any malfunctioning and / or out of calibration analytical instruments (including glassware) is used.",
                                        "Whether reference standard / working standard is correct (in terms of appearance, purity, LOD/water content & its storage) and assay values are determined correctly.",
                                        "Whether test solution / volumetric solution used are properly prepared & standardized.",
                                        "Review RSD, resolution factor and other parameters required for the suitability of the test system. Check if any out of limit parameters is included in the chromatographic analysis, correctness of the column used previous use of the column.",
                                        "In the raw data, including chromatograms and spectra; any anomalous or suspect peaks or data has been observed.",
                                        "Any such type of observation has been observed previously (Assay, Dissolution etc.).",
                                        "Any unusual or unexpected response observed with standard or test preparations (e.g. whether contamination of equipment by previous sample observed).",
                                        "System suitability conditions met (those before analysis and during analysis).",
                                        "Correct and clean pipette / volumetric flasks volumes, glassware used as per recommendation.",
                                        "Other potentially interfering testing/activities occurring at the time of the test which might lead to OOS.",
                                        "Review of other data for other batches performed within the same analysis set and any nonconformance observed.",
                                        "Consideration of any other OOS results obtained on the batch of material under test and any non-conformance observed.",
                                        "Media/Reagents prepared according to procedure.",
                                        "All the materials are within the due period of expiry.",
                                        "Whether, analysis was performed by any other alternate validated procedure",
                                        "Whether environmental condition is suitable to perform the test.",
                                        "Interview with analyst to assess knowledge of the correct procedure."

                                ];
                            @endphp
                            <div class="group-input ">

                                <div class="why-why-chart mx-auto" style="width: 100%">

                                    <table class="table table-bordered ">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">Sr.No.</th>
                                                <th style="width: 40%;">Question</th>
                                                <th style="width: 20%;">Response</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($phase_I_investigations as $phase_I_investigation )
                                            <tr>
                                                <td class="flex text-center">{{$loop->index+1}}</td>
                                                <td>{{$phase_I_investigation}}</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="phase_IB_investigation[{{$loop->index}}][response]" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="">Select an Option</option>
                                                            <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'phase_IB_investigation', true, 'response', true, $loop->index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                            <option value="No" {{ Helpers::getMicroGridData($micro_data, 'phase_IB_investigation', true, 'response', true, $loop->index) == 'No' ? 'selected' : '' }} >No</option>
                                                            <option value="N/A"  {{ Helpers::getMicroGridData($micro_data, 'phase_IB_investigation', true, 'response', true, $loop->index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="phase_IB_investigation[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getMicroGridData($micro_data, 'phase_IB_investigation', true, 'remark', true, $loop->index) }}
                                                        </textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            {{--<tr>
                                                <td class="flex text-center">2</td>
                                                <td>Visual examination (solid and solution) reveals normal or abnormal
                                                    appearance.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">3</td>
                                                <td>The analyst is trained on the method.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td class="flex text-center">4</td>
                                                <td>Correct test procedure followed e.g. Current Version of standard testing
                                                    procedure has been used in testing.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">5</td>
                                                <td>Current Validated analytical Method has been used and the data of
                                                    analytical method validation has been reviewed and found satisfactory.
                                                </td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">6</td>
                                                <td>Correct sample(s) tested.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">7</td>
                                                <td>Sample Integrity maintained, correct container is used in testing.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">8</td>
                                                <td>Assessment of the possibility that the sample contamination (sample left
                                                    open to air or unattended) has occurred during the testing/ re-testing
                                                    procedure. </td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">9</td>
                                                <td>All equipment used in the testing is within calibration due period.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">10</td>
                                                <td>Equipment log book has been reviewed and no any failure or malfunction
                                                    has been reviewed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">11</td>
                                                <td>Any malfunctioning and / or out of calibration analytical instruments
                                                    (including glassware) is used.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>


                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">12</td>
                                                <td>Whether reference standard / working standard is correct (in terms of
                                                    appearance, purity, LOD/water content & its storage) and assay values
                                                    are determined correctly.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">13</td>
                                                <td>Whether test solution / volumetric solution used are properly prepared &
                                                    standardized.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">14</td>
                                                <td>Review RSD, resolution factor and other parameters required for the
                                                    suitability of the test system. Check if any out of limit parameters is
                                                    included in the chromatographic analysis, correctness of the column used
                                                    previous use of the column.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">15</td>
                                                <td>In the raw data, including chromatograms and spectra; any anomalous or
                                                    suspect peaks or data has been observed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">16</td>
                                                <td>Any such type of observation has been observed previously (Assay,
                                                    Dissolution etc.).</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">17</td>
                                                <td>Any unusual or unexpected response observed with standard or test
                                                    preparations (e.g. whether contamination of equipment by previous sample
                                                    observed).</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">18</td>
                                                <td>System suitability conditions met (those before analysis and during
                                                    analysis).</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">19</td>
                                                <td>Correct and clean pipette / volumetric flasks volumes, glassware used as
                                                    per recommendation.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">20</td>
                                                <td>Other potentially interfering testing/activities occurring at the time
                                                    of the test which might lead to OOS.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">21</td>
                                                <td>Review of other data for other batches performed within the same
                                                    analysis set and any nonconformance observed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">22</td>
                                                <td>Consideration of any other OOS results obtained on the batch of material
                                                    under test and any non-conformance observed.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">23</td>
                                                <td>Media/Reagents prepared according to procedure.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">24</td>
                                                <td>All the materials are within the due period of expiry.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">25</td>
                                                <td>Whether, analysis was performed by any other alternate validated
                                                    procedure</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="flex text-center">26</td>
                                                <td>Whether environmental condition is suitable to perform the test.</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="flex text-center">27</td>
                                                <td>Interview with analyst to assess knowledge of the correct procedure</td>
                                                <td>
                                                    <div
                                                        style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                        <select name="response" id="response"
                                                            style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                            <option value="Yes">Select an Option</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td style="vertical-align: middle;">
                                                    <div style="margin: auto; display: flex; justify-content: center;">
                                                        <textarea name="what_will_not_be" style="border-radius: 7px; border: 1.5px solid black;"></textarea>
                                                    </div>
                                                </td>
                                            </tr>--}}
                                        </tbody>
                                    </table>
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
 <!-- Preliminary Lab Inv. Conclusion -->
<div id="CCForm3" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Investigation Conclusion</div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary of Prelim.Investiga.</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="summary_of_prelim_investiga_plic" id="summernote-1">{{ $micro_data->summary_of_prelim_investiga_plic }}
                        </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Lead Auditor">Root Cause Identified</label>
                    <!-- <div class="text-primary">Please Choose the relevent units</div> -->
                    <select name="root_cause_identified_plic">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->root_cause_identified_plic == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->root_cause_identified_plic == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Team"> OOS Category-Root Cause Ident.</label>
                    <select name="oos_category_root_cause_ident_plic">
                        <option value="">Enter Your Selection Here</option>
                        <option value="analyst-error" @if ($micro_data->oos_category_root_cause_ident_plic == 'analyst-error') selected @endif>Analyst Error</option>
                        <option value="instrument-error" @if ($micro_data->oos_category_root_cause_ident_plic == 'instrument-error') selected @endif>Instrument Error</option>
                        <option value="product-material-related-error" @if ($micro_data->oos_category_root_cause_ident_plic == 'product-material-related-error') selected @endif>Product/Material Related Error</option>
                        <option value="other-error" @if ($micro_data->oos_category_root_cause_ident_plic == 'other-error') selected @endif>Other Error</option>

                    </select>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">OOS Category (Others)</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="oos_category_others_plic" id="summernote-1">{{ $micro_data->oos_category_others_plic }}
                        </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Root Cause Details</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="root_cause_details_plic" id="summernote-1">{{ $micro_data->root_cause_details_plic }}
                        </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">OOS Category-Root Cause Ident.</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="oos_category_root_cause_plic" id="summernote-1">{{ $micro_data->oos_category_root_cause_plic }}
                        </textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">Recommended Actions Required?</label>
                    <select name="recommended_actions_required_plic">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->recommended_actions_required_plic == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->recommended_actions_required_plic == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Recommended Actions Reference
                    </label>
                    <select multiple id="reference_record" name="recommended_actions_reference_plic[]" id="">
                        <option value="">--Select---</option>
                        <option value="1" {{ (!empty($micro_data->recommended_actions_reference_plic) && in_array('1', explode(',', $micro_data->recommended_actions_reference_plic[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->recommended_actions_reference_plic) && in_array('2', explode(',', $micro_data->recommended_actions_reference_plic[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">CAPA Required</label>
                    <select name="capa_required_plic">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->capa_required_plic == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->capa_required_plic == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Agenda">Reference CAPA No.</label>
                    <input type="num" name="reference_capa_no_plic" value="{{ $micro_data->reference_capa_no_plic }}">
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Delay Justification for P.I.</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="delay_justification_for_pi_plic" id="summernote-1">{{ $micro_data->delay_justification_for_pi_plic }}
                        </textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Attachments"> Supporting Attachment </label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="supporting_attachment_plic">
                            @if ($micro_data->supporting_attachment_plic)
                            @foreach ($micro_data->supporting_attachment_plic as $file)
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
                            <input type="file" id="myfile" name="supporting_attachment_plic[]"
                                oninput="addMultipleFiles(this, 'supporting_attachment_plic')" multiple>
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

<!-- Preliminary Lab Invst. Review--->
<div id="CCForm4" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">Preliminary Lab Invstigation Review</div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Review Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="review_comments_plir" id="summernote-1">{{ $micro_data->review_comments_plir }}
                    </textarea>
                </div>
            </div>

            <div class="sub-head">OOS Review for Similar Nature</div>

            <!-- ---------------------------grid-1 ---Preliminary Lab Invst. Review----------------------------- -->
            <div class="group-input">
                <label for="audit-agenda-grid">
                    Info. On Product/ Material
                    <button type="button" name="audit-agenda-grid" id="oos_capa">+</button>
                    <span class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#document-details-field-instruction-modal"
                        style="font-size: 0.8rem; font-weight: 400; cursor: pointer;">
                        (Launch Instruction)
                    </span>
                </label>
                <div class="table-responsive">
                    <table class="table table-bordered" id="oos_capa_details" style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="width: 4%">Row#</th>
                                <th style="width: 8%">OOS Number</th>
                                <th style="width: 14%"> OOS Reported Date</th>
                                <th style="width: 12%">Description of OOS</th>
                                <th style="width: 12%">Previous OOS Root Cause</th>
                                <th style="width: 12%"> CAPA</th>
                                <th style="width: 14% pt-3">Closure Date of CAPA</th>
                                <th style="width: 12%">CAPA Requirement</th>
                                <th style="width: 10%">Reference CAPA Number</th>
                                <th style="widht: 4%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if ($oos_capas)
                               @foreach ($oos_capas->data as $oos_capa)
                                    <tr>
                                        <td><input disabled type="text" name="oos_capa[{{ $loop->index }}][serial]" value="{{ $loop->index + 1 }}"></td>
                                        <td><input type="text" id="info_oos_number" name="oos_capa[{{ $loop->index }}][info_oos_number]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_number') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input type="text" name="oos_capa[{{ $loop->index }}][info_oos_reported_date]" value="{{ Helpers::getdateFormat($oos_capa['info_oos_reported_date'] ?? '') }}"
                                                     id="info_oos_reported_date_{{ $loop->index }}" placeholder="DD-MM-YYYY" />
                                                    <input type="date" name="oos_capa[{{ $loop->index }}][info_oos_reported_date]" value="{{ $oos_capa['info_oos_reported_date'] ?? '' }}" 
                                                    class="hide-input" oninput="handleDateInput(this, 'info_oos_reported_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_description]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_description') }}"></td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_previous_root_cause]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_previous_root_cause') }}"></td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_capa]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_capa') }}"></td>
                                        <td>
                                        <div class="col-lg-6 new-date-data-field">
                                            <div class="group-input input-date">
                                                <div class="calenderauditee">
                                                    <input type="text" name="oos_capa[{{ $loop->index }}][info_oos_closure_date]" value="{{ Helpers::getdateFormat($oos_capa['info_oos_closure_date'] ?? '') }}"
                                                       id="info_oos_closure_date_{{ $loop->index }}"  placeholder="DD-MM-YYYY" />
                                                    <input type="date" name="oos_capa[{{ $loop->index }}][info_oos_closure_date]" value="{{ $oos_capa['info_oos_closure_date'] ?? '' }}" 
                                                    class="hide-input" oninput="handleDateInput(this, 'info_oos_closure_date_{{ $loop->index }}')">
                                                </div>
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                            <select name="oos_capa[{{ $loop->index }}][info_oos_capa_requirement]">
                                                <option vlaue="">--select--</option>
                                                <option value="yes" {{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_requirement') == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_requirement') == 'No' ? 'selected' : '' }}>No</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="oos_capa[{{ $loop->index }}][info_oos_capa_reference_number]" value="{{ Helpers::getArrayKey($oos_capa, 'info_oos_capa_reference_number') }}"></td> 
                                        <td><button type="text" class="removeRowBtn">Remove</button></td>
                                    </tr>
                               @endforeach
                           @endif
                            

                            {{-- <td><input disabled type="text" name="serial[]" value="1"></td>
                            <td><input type="text" name="Number[]"></td>
                            <td><input type="text" name="Name[]"></td>
                            <td><input type="text" name="Remarks[]"></td>
                            <td><input type="text" name="Number[]"></td>
                            <td><input type="text" name="Name[]"></td>
                            <td><input type="text" name="Remarks[]"></td>
                            <td><select name="CAPARequirement[]">
                                    <option>Yes</option>
                                    <option>No</option>
                                </select></td>
                            <td><input type="text" name="Name[]"></td> --}}


                        </tbody>

                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date"> Phase II Inv. Required?</label>
                    <select name="phase_ii_inv_required_plir">
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->phase_ii_inv_required_plir == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->phase_ii_inv_required_plir == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Supporting Attachments</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="supporting_attachments_plir">
                            @if ($micro_data->supporting_attachments_plir)
                            @foreach ($micro_data->supporting_attachments_plir as $file)
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
                            <input type="file" id="myfile" name="supporting_attachments_plir[]"
                                oninput="addMultipleFiles(this, 'supporting_attachments_plir')" multiple>
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

