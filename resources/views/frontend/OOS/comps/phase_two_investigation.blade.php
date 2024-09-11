@php
    $phase_two_inv_questions = array(
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
        "All the in-process checks were carried out as per the frequency given in BMR & the results were within acceptance limit?",
        "Whether there were any failures of utilities (like Power, Compressed air, steam etc.) during manufacturing?",
        "Whether other batches/products impacted?",
        "Any Other"
    );

@endphp

<div id="CCForm5" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            CheckList - Phase II Investigation
        </div>
        <div class="row">
            <div class="col-12">
                <center>
                   <label style="font-weight: bold;" for="Audit Attachments">PHASE II OOS INVESTIGATION</label>
               </center>
               <!-- <label for="Reference Recores"> </label> -->
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
                               @if ($phase_two_invss)
                                   @foreach ($phase_two_inv_questions as $phase_two_inv_question)
                                       <tr>
                                           <td class="flex text-center">{{ $loop->index+1 }}</td>
                                           <td>{{ $phase_two_inv_question }}</td>
                                           <td>
                                               <div style="display: flex; justify-content: space-around; align-items: center;  margin: 5%; gap:5px">
                                                   <select {{Helpers::isOOSChemical($data->stage)}}  name="phase_two_inv1[{{ $loop->index }}][response]" id="response" style="padding: 2px; width:90%; border: 1px solid black;  background-color: #f0f0f0;">
                                                       <option value="">Select an Option</option>
                                                       <option value="Yes" {{ Helpers::getArrayKey($phase_two_invss->data[$loop->index], 'response') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                                       <option value="No" {{ Helpers::getArrayKey($phase_two_invss->data[$loop->index], 'response') == 'No' ? 'selected' : '' }}>No</option>
                                                       <option value="N/A" {{ Helpers::getArrayKey($phase_two_invss->data[$loop->index], 'response') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                   </select>
                                               </div>
                                           </td>
                                           <td>
                                               <textarea {{Helpers::isOOSChemical($data->stage)}} name="phase_two_inv1[{{ $loop->index }}][remarks]" style="border-radius: 7px; border: 1.5px solid black;">{{ Helpers::getArrayKey($phase_two_invss->data[$loop->index], 'remarks') }}</textarea>
                                           </td>
                                       </tr>
                                   @endforeach
                               @endif
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>

            <div class="sub-head">
                Phase II A Investigation
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">QA Approver Comments</label>
                    <textarea class="summernote" name="qa_approver_comments_piii" id="summernote-1">
                    {{$data->qa_approver_comments_piii ? $data->qa_approver_comments_piii : ""}}</textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Reason for manufacturing</label>
                    <textarea class="summernote" name="reason_manufacturing_piii" id="summernote-1">
                    {{$data->reason_manufacturing_piii ? $data->reason_manufacturing_piii : ""}}</textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Report Attachments"> Manufact. Invest. Required? </label>
                    <select name="manufact_invest_required_piii" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Yes" {{ $data->manufact_invest_required_piii === 'Yes' ? 'selected' :
                                '' }}>Yes</option>
                        <option value="No" {{ $data->manufact_invest_required_piii === 'No' ? 'selected' : ''
                                }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Auditee"> Manufacturing Invest. Type </label>
                    <select  name="manufacturing_invest_type_piii" placeholder="Select Nature of Deviation"
                        data-search="false" data-silent-initial-value-set="true" id="auditee" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Chemical"{{ $data->manufacturing_invest_type_piii === 'Chemical' ? 'selected' :
                            '' }}>Chemical</option>
                        <option value="Microbiology"{{ $data->manufacturing_invest_type_piii === 'Microbiology' ? 'selected' :
                            '' }}>Microbiology</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Audit Comments"> Audit Comments </label>
                    <textarea  class="summernote" type="audit_comments_piii" name="audit_comments_piii" {{ $data->stage == 13 ? '' : 'disabled' }}>{{$data->audit_comments_piii ? $data->audit_comments_piii : ""}}
                    </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Attachments"> Hypo/Exp. Required</label>
                    <select name="hypo_exp_required_piii" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                       <option value="" {{ $data->hypo_exp_required_piii == '0' ? 'selected' : ''
                            }}>Enter Your Selection Here</option>
                        <option value="yes" {{ $data->hypo_exp_required_piii == 'yes' ?
                            'selected' : '' }}>yes</option>
                        <option value="no" {{ $data->hypo_exp_required_piii == 'no' ?
                            'selected' : '' }}>no</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Reference Recores">Hypo/Exp. Reference</label>
                    <textarea class="summernote" name="hypo_exp_reference_piii" id="summernote-1">
                    {{$data->hypo_exp_reference_piii ? $data->hypo_exp_reference_piii : ""}}</textarea>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="group-input">
                    <label for="Audit Attachments"> Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attachments_pII">
                        @if ($data->file_attachments_pII)
                            @foreach ($data->file_attachments_pII as $file)
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
                            <input type="file" id="myfile" name="file_attachments_pII[]"
                                oninput="addMultipleFiles(this, 'file_attachments_pII')" {{ $data->stage == 13 ? '' : 'disabled' }} multiple>
                        </div>
                    </div>

                </div>
            </div>
            <div class="sub-head">Summary of Phase II Testing</div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary of Exp./Hyp.</label>
                    <textarea class="summernote" name="summary_of_exp_hyp_piiqcr" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                {{$data->summary_of_exp_hyp_piiqcr ?  $data->summary_of_exp_hyp_piiqcr : ''}}
                </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Summary Mfg. Investigation</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="summary_mfg_investigation_piiqcr" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                          {{$data->summary_mfg_investigation_piiqcr ? $data->summary_mfg_investigation_piiqcr : ''}}
                    </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Cancelled By"> Root Casue Identified</label>
                    <select name="root_casue_identified_piiqcr" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data->root_casue_identified_piiqcr === 'yes' ? 'selected' :
                            '' }}>Yes</option>
                        <option value="no" {{ $data->root_casue_identified_piiqcr === 'no' ? 'selected' : ''
                            }}>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Cancelled By">OOS Category-Reason identified </label>
                    <select name="oos_category_reason_identified_piiqcr" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="Analyst Error"{{ $data->oos_category_reason_identified_piiqcr ===
                            'Analyst Error' ? 'selected' : '' }}>Analyst Error</option>
                        <option value="Instrument Error"{{ $data->oos_category_reason_identified_piiqcr ===
                            'Instrument Error' ? 'selected' : '' }}>Instrument Error</option>
                        <option value="Product/Material Related Error"{{ $data->oos_category_reason_identified_piiqcr ===
                            'Product/Material Related Error' ? 'selected' : '' }}>Product/Material Related Error</option>
                        <option value="Other Error"{{ $data->oos_category_reason_identified_piiqcr ===
                            'Other Error' ? 'selected' : '' }}>Other Error</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Preparation Completed On">Others (OOS category)</label>
                    <input type="text" name="others_oos_category_piiqcr"
                        value="{{$data->others_oos_category_piiqcr}}" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Details of Obvious Error">Details of Obvious Error</label>
                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" name="oos_details_obvious_error" value="{{ $data->oos_details_obvious_error }}" {{ $data->stage == 13 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Details of Root Cause</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="details_of_root_cause_piiqcr" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                {{$data->details_of_root_cause_piiqcr ? $data->details_of_root_cause_piiqcr : ''}}
                </textarea>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Impact Assessment.</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="impact_assessment_piiqcr" id="summernote-1" {{Helpers::isOOSChemical($data->stage)}}>
                  {{$data->impact_assessment_piiqcr ? $data->impact_assessment_piiqcr : ""}}
                </textarea>
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

                            @if ($data->attachments_piiqcr)
                            @foreach($data->attachments_piiqcr as $file)
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
                            <input type="file" id="myfile" name="attachments_piiqcr[]"
                                oninput="addMultipleFiles(this, 'attachments_piiqcr')" {{ $data->stage == 13 ? '' : 'disabled' }} multiple {{Helpers::isOOSChemical($data->stage)}}>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Product/Material Name">CAPA Required</label>
                    <select name="capa_required_iia"  {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                        <option value="" {{ $data->capa_required_iia == '0' ? 'selected' : ''
                            }}>--Select---</option>
                        <option value="yes" {{ $data->capa_required_iia == 'yes' ? 'selected' : ''
                            }}>Yes</option>
                        <option value="no" {{ $data->capa_required_iia == 'no' ? 'selected' : '' }}>No
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Agenda">Reference CAPA No.</label>
                    <input  {{Helpers::isOOSChemical($data->stage)}} type="text" value="{{$data->reference_capa_no_iia}}" name="reference_capa_no_iia" {{ $data->stage == 13 ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Exclamation FAR (Field alert) </label>
                    <textarea class="summernote" name="Field_alert_QA_initial_approval" id="summernote-1">
                    {{ $data->Field_alert_QA_initial_approval ?? '' }} </textarea>
                </div>
            </div> 
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Audit Start Date">Phase IIB Inv. Required?</label>
                    <select name="phase_iib_inv_required_plir" {{Helpers::isOOSChemical($data->stage)}} {{ $data->stage == 13 ? '' : 'disabled' }}>
                        <option value="">Enter Your Selection Here</option>
                        <option value="yes" {{ $data && $data->phase_iib_inv_required_plir == 'yes' ?
                            'selected' : '' }}>Yes</option>
                        <option value="no" {{ $data && $data->phase_iib_inv_required_plir == 'no' ?
                            'selected' : '' }}>No</option>
                    </select>
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