 <!--Phase II Investigation -->
<div id="CCForm5" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Phase II Investigation
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">QA Approver Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="qa_approver_comments_piii"
                        id="summernote-1" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        {{ $micro_data->qa_approver_comments_piii }}
                    </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments"> Manufact. Invest. Required? </label>
                    <select name="manufact_invest_required_piii" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->manufact_invest_required_piii == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->manufact_invest_required_piii == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>


            <div class="col-lg-6">
                <div class="group-input">

                <label for="Auditee"> Manufacturing Invest. Type </label>
                    <select multiple name="manufacturing_invest_type_piii[]" placeholder="Select Nature of Deviation"
                        data-search="false" data-silent-initial-value-set="true" id="auditee" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">--Select---</option>
                            <option value="chemical" {{ (!empty($micro_data->manufacturing_invest_type_piii) && in_array('chemical', explode(',', $micro_data->manufacturing_invest_type_piii[0]))) ? 'selected' : '' }}>1</option>
                        <option value="microbiology" {{ (!empty($micro_data->manufacturing_invest_type_piii) && in_array('microbiology', explode(',', $micro_data->manufacturing_invest_type_piii[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Manufacturing Invst. Ref.</label>
                    <select multiple id="reference_record" name="manufacturing_invst_ref_piii[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">--Select---</option>
                        <option value="1" {{ (!empty($micro_data->manufacturing_invst_ref_piii) && in_array('1', explode(',', $micro_data->manufacturing_invst_ref_piii[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->manufacturing_invst_ref_piii) && in_array('2', explode(',', $micro_data->manufacturing_invst_ref_piii[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Re-sampling Required? </label>
                    <select name="re_sampling_required_piii">
                         <option value="">Enter Your Selection Here</option>
                         <option value="yes" @if ($micro_data->re_sampling_required_piii == 'yes') selected @endif>Yes</option>
                         <option value="no" @if ($micro_data->re_sampling_required_piii == 'no') selected @endif>No</option>

                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Comments"> Audit Comments </label>
                    <textarea name="audit_comments_piii" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->audit_comments_piii}}</textarea>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Re-sampling Ref. No.</label>
                    <select multiple id="reference_record" name="re_sampling_ref_no_piii[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">--Select---</option>
                        <option value="1" {{ (!empty($micro_data->re_sampling_ref_no_piii) && in_array('1', explode(',', $micro_data->re_sampling_ref_no_piii[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->re_sampling_ref_no_piii) && in_array('2', explode(',', $micro_data->re_sampling_ref_no_piii[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Hypo/Exp. Required</label>
                    <select name="hypo_exp_required_piii" {{Helpers::isOOSMicro($micro_data->stage)}}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" @if ($micro_data->hypo_exp_required_piii == 'yes') selected @endif>Yes</option>
                        <option value="no" @if ($micro_data->hypo_exp_required_piii == 'no') selected @endif>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Hypo/Exp. Reference</label>
                    <select multiple id="reference_record" name="hypo_exp_reference_piii[]" id {{Helpers::isOOSMicro($micro_data->stage)}}
                        <option value="">--Select---</option>
                        <option value="1" {{ (!empty($micro_data->hypo_exp_reference_piii) && in_array('1', explode(',', $micro_data->hypo_exp_reference_piii[0]))) ? 'selected' : '' }}>1</option>
                        <option value="2" {{ (!empty($micro_data->hypo_exp_reference_piii) && in_array('2', explode(',', $micro_data->hypo_exp_reference_piii[0]))) ? 'selected' : '' }}>2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="attachment_piii">
                            @if ($micro_data->attachment_piii)
                            @foreach ($micro_data->attachment_piii as $file)
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
                            <input {{Helpers::isOOSMicro($micro_data->stage)}} type="file" id="myfile" name="attachment_piii[]"
                                oninput="addMultipleFiles(this, 'attachment_piii')" multiple>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <label for="Reference Recores">PHASE II OOS INVESTIGATION </label>
@php
$phase_II_OOS_investigations = [
"Is correct batch manufacturing record used?",
"Correct quantities of correct ingredients were used in manufacturing?",
"Balances used in dispensing / verification were calibrated using valid standard weights?",
"Equipment used in the manufacturing is as per batch manufacturing record?",
"Processing steps followed in correct sequence as per the BMR?",
"Whether material used in the batch had any OOS result?",
"All the processing parameters were within the range specified in BMR?",
"Environmental conditions during manufacturing are as per BMR?",
"Whether there was any deviation observed during manufacturing?",
"The yields at different stages were within the acceptable range as per BMR?",
"All the equipment’s used during manufacturing are calibrated?",
"Whether there is malfunctioning or breakdown of equipment during manufacturing?",
"Whether the processing equipment was maintained as per preventive maintenance schedule?",
"All the in process checks were carried out as per the frequency given in BMR & the results were within acceptance limit?",
"Whether there were any failures of utilities (like Power, Compressed air, steam etc.) during manufacturing?",
"Whether other batches/products impacted?",
"Any Other"
];
@endphp
                <div class="group-input">
                    <div class="why-why-chart">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">Sr.No.</th>
                                    <th style="width: 40%;">Question</th>
                                    <th style="width: 20%;">Response</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($phase_II_OOS_investigations as $phase_II_OOS_investigation )

                                <tr>
                                    <td class="flex text-center">{{$loop->index+1}}</td>
                                    <td>{{$phase_II_OOS_investigation}}</td>
                                    <td>
                                        <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                            <select name="phase_II_OOS_investigation[{{$loop->index}}][response]" id="response"
                                                style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;" {{Helpers::isOOSMicro($micro_data->stage)}} >
                                                <option value="">Select an Option</option>
                                                <option value="Yes" {{ Helpers::getMicroGridData($micro_data, 'phase_II_OOS_investigation', true, 'response', true, $loop->index) == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ Helpers::getMicroGridData($micro_data, 'phase_II_OOS_investigation', true, 'response', true, $loop->index) == 'No' ? 'selected' : '' }} >No</option>
                                                <option value="N/A"  {{ Helpers::getMicroGridData($micro_data, 'phase_II_OOS_investigation', true, 'response', true, $loop->index) == 'N/A' ? 'selected' : '' }}>N/A</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div style="margin: auto; display: flex; justify-content: center;">
                                            <textarea {{Helpers::isOOSMicro($micro_data->stage)}} name="phase_II_OOS_investigation[{{$loop->index}}][remark]" style="border-radius: 7px; border: 1.5px solid black;">
                                                {{ Helpers::getMicroGridData($micro_data, 'phase_II_OOS_investigation', true, 'remark', true, $loop->index) }}
                                            </textarea>
                                        </div>
                                    </td>   
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
  

 <!-- Phase II QC Review -->
 <div id="CCForm6" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">Summary of Phase II Testing</div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary of Exp./Hyp.</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_of_exp_hyp_piiqcr" 
                            id="summernote-1" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->summary_of_exp_hyp_piiqcr }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Summary Mfg. Investigation</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="summary_mfg_investigation_piiqcr" 
                            id="summernote-1" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->summary_mfg_investigation_piiqcr }} </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Cancelled By"> Root Casue Identified. </label>
                            <select name="root_casue_identified_piiqcr" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->root_casue_identified_piiqcr == 'yes') selected @endif>Yes</option>
                                <option value="no" @if ($micro_data->root_casue_identified_piiqcr == 'no') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Cancelled By">OOS Category-Reason identified </label>
                            <select name="oos_category_reason_identified_piiqcr" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">Enter Your Selection Here</option>
                                <option value="analyst-error" @if ($micro_data->oos_category_reason_identified_piiqcr == 'analyst-error') selected @endif>Analyst Error</option>
                                <option value="instrument-error" @if ($micro_data->oos_category_reason_identified_piiqcr == 'instrument-error') selected @endif>Instrument Error</option>
                                <option value="product-material-related-error" @if ($micro_data->oos_category_reason_identified_piiqcr == 'product-material-related-error') selected @endif>Product/Material Related Error</option>
                                <option value="other-error" @if ($micro_data->oos_category_reason_identified_piiqcr == 'other-error') selected @endif>Other Error</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Preparation Completed On">Others (OOS category)</label>
                            <input  {{Helpers::isOOSMicro($micro_data->stage)}} type="string" name="others_oos_category_piiqcr" value="{{ $micro_data->others_oos_category_piiqcr }}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Details of Obvious Error">Details of Obvious Error</label>
                            <input  {{Helpers::isOOSMicro($micro_data->stage)}} type="text" name="oos_details_obvious_error" value="{{ $micro_data->oos_details_obvious_error }}">
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Details of Root Cause</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="details_of_root_cause_piiqcr" 
                            id="summernote-1" {{Helpers::isOOSMicro($micro_data->stage)}}>{{ $micro_data->details_of_root_cause_piiqcr }}
                                    </textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Impact Assessment.</label>
                                <textarea {{Helpers::isOOSMicro($micro_data->stage)}} class="summernote" name="impact_assessment_piiqcr" id="summernote-1">{{ $micro_data->impact_assessment_piiqc }}
                                </textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Mgr.more Info Reqd On">Recommended Action Required? </label>
                            <select name="recommended_action_required_piiqcr" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">Enter Your Selection Here</option>
                                <option value="yes" @if ($micro_data->recommended_action_required_piiqcr == 'yes') selected @endif>yes</option>
                                <option value="No" @if ($micro_data->recommended_action_required_piiqcr == 'No') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Recommended Action Reference</label>
                            <select multiple id="reference_record" name="recommended_action_reference_piiqcr[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->recommended_action_reference_piiqcr) && in_array('1', explode(',', $micro_data->recommended_action_reference_piiqcr[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->recommended_action_reference_piiqcr) && in_array('2', explode(',', $micro_data->recommended_action_reference_piiqcr[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Observation Submitted On">Investi. Required</label>
                            <select name="investi_required_piiqcr" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">Enter Your Selection Here</option>
                                <option value="Yes" @if ($micro_data->investi_required_piiqcr == 'Yes') selected @endif>Yes</option>
                                <option value="No" @if ($micro_data->investi_required_piiqcr == 'No') selected @endif>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Invest ref.</label>
                            <select multiple id="reference_record" name="invest_ref_piiqcr[]" id="" {{Helpers::isOOSMicro($micro_data->stage)}}>
                                <option value="">--Select---</option>
                                <option value="1" {{ (!empty($micro_data->invest_ref_piiqcr) && in_array('1', explode(',', $micro_data->invest_ref_piiqcr[0]))) ? 'selected' : '' }}>1</option>
                                <option value="2" {{ (!empty($micro_data->invest_ref_piiqcr) && in_array('2', explode(',', $micro_data->invest_ref_piiqcr[0]))) ? 'selected' : '' }}>2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Audit Lead More Info Reqd On">Attachments </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="attachments_piiqcr">
                                    @if ($micro_data->attachments_piiqcr)
                                    @foreach ($micro_data->attachments_piiqcr as $file)
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
                                    <input {{Helpers::isOOSMicro($micro_data->stage)}} type="file" id="myfile" name="attachments_piiqcr[]"
                                        oninput="addMultipleFiles(this, 'attachments_piiqcr')" multiple>
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