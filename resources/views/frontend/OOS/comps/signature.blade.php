<div id="CCForm17" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Activity Log
        </div>
        <div class="row">
                        <!-- Submit -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Agenda">Submited by</label>
                                <div class="static">{{ $data->completed_by_submit }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Agenda">Submited on</label>
                                <div class="Date">{{ $data->completed_on_submit }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_submit }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!--  Initial Phase I Investigation  Done By -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Team"> Initial Phase I Investigation  By</label>
                                <div class="static">{{ $data->completed_by_pending_initial_assessment }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Team"> Initial Phase I Investigation  On</label>
                                <div class="Date">{{ $data->completed_on_pending_initial_assessment }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_pending_initial_assessment }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Assignable Cause Found -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Comments"> Assignable Cause Found By </label>
                                <div class="static">{{ $data->completed_by_assignable_cause_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Assignable Cause Found On</label>
                                <div class="Date">{{ $data->completed_on_assignable_cause_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_assignable_cause_found }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Assignable Cause Not Found -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Assignable Cause Not Found By</label>
                                <div class="static">{{ $data->completed_by_assignable_cause_not_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Assignable Cause Not Found On</label>
                                <div class="Date">{{ $data->completed_on_assignable_cause_not_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_assignable_cause_not_found }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Correction Completed -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Correction Completed By</label>
                                <div class="static">{{ $data->completed_by_correction_completed }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Correction Completed On</label>
                                <div class="Date">{{ $data->completed_on_correction_completed }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_correction_completed }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Proposed Hypothesis Experiment -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Response Completed By"> Proposed Hypothesis Experiment Done By</label>
                                <div class=" static">{{ $data->completed_by_proposed_hypothesis_experiment }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Response Completed On">Proposed Hypothesis Experiment Done On</label>
                                <div class="date">{{ $data->completed_on_proposed_hypothesis_experiment }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_proposed_hypothesis_experiment }}</div>
                           </div>
                        </div>
                        <!-- Obvious Error Found -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Obvious Error Found By</label>
                                <div class=" static">{{ $data->completed_by_obvious_error_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Obvious Error Found On</label>
                                <div class="date">{{ $data->completed_on_obvious_error_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_obvious_error_found }}</div>
                           </div>
                        </div>
                        <!-- No Assignable Cause Found -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">No Assignable Cause Found By</label>
                                <div class=" static">{{ $data->completed_by_no_assignable_cause_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">No Assignable Cause Found On</label>
                                <div class="date">{{ $data->completed_on_no_assignable_cause_found }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_no_assignable_cause_found }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Repeat Analysis Completed -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Repeat Analysis Completed By</label>
                                <div class=" static">{{ $data->completed_by_repeat_analysis_completed }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Repeat Analysis Completed On</label>
                                <div class="date">{{ $data->completed_on_repeat_analysis_completed }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_repeat_analysis_completed }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Full Scale Investigation -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Full Scale Investigation Done by</label>
                                <div class=" static">{{ $data->completed_by_full_scale_investigation }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Audit Attachments">Full Scale Investigation Done On</label>
                                <div class="date">{{ $data->completed_on_full_scale_investigation }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_full_scale_investigation }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Assignable Cause Found (Manufacturing Defect) -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Assignable Cause Found (Manufacturing Defect) Complete By </label>
                                <div class=" static">{{ $data->completed_by_assignable_manufacturing_defect }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Assignable Cause Found Complete on </label>
                                <div class="date">{{ $data->completed_on_assignable_manufacturing_defect }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_assignable_manufacturing_defect }}</div>
                           </div>
                        </div>
                        <!-- No Assignable Cause Found (No Manufacturing Defect) -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">No Assignable Cause Found (No Manufacturing Defect) Completed By </label>
                                <div class=" static">{{ $data->completed_by_no_assignable_manufacturing_defect }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">No Assignable Cause Found (No Manufacturing Defect) Completed on </label>
                                <div class="date">{{ $data->completed_on_no_assignable_manufacturing_defect }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_no_assignable_manufacturing_defect }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                         <!-- Phase II Correction Completed  -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Correction Completed Done By </label>
                                <div class="static">{{ $data->completed_by_phaseII_correction_complete }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Correction Completed Done On </label>
                                <div class="date">{{ $data->completed_on_phaseII_correction_complete }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_phaseII_correction_complete }}</div>
                           </div>
                        </div>
                        <!--  Phase II A Correction Inconclusive -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Phase II A Correction Inconclusive Done By</label>
                                <div class=" static">{{ $data->completed_by_phaseIIA_correction_inconclusive }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Phase II A Correction Inconclusive Done On</label>
                                <div class="date">{{ $data->completed_on_phaseIIA_correction_inconclusive }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_phaseIIA_correction_inconclusive }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                         <!-- Retesting/resampling -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Retesting/resampling Done By </label>
                                <div class=" static">{{ $data->completed_by_retesting_resampling }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Retesting/resampling Done On </label>
                                <div class="date">{{ $data->completed_on_retesting_resampling }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_retesting_resampling }}</div>
                           </div>
                        </div>
                        <!-- Phase II B Correction Inconclusive -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Phase II B Correction Inconclusive Done By </label>
                                <div class=" static">{{ $data->completed_by_phaseIIB_correction_inconclusive }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Phase II B Correction Inconclusive Done On </label>
                                <div class="date">{{ $data->completed_on_phaseIIB_correction_inconclusive }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_phaseIIB_correction_inconclusive }}</div>
                           </div>
                        </div>
           <!-- comment_phaseIII_manufacturing_investigation -->
           <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Phase III Manufacturing Investigation Done By </label>
                                <div class=" static">{{ $data->completed_by_phaseIII_manufacturing_investigation }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Reference Recores">Phase III Manufacturing Investigation Done On </label>
                                <div class="date">{{ $data->completed_on_phaseIII_manufacturing_investigation }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_phaseIII_manufacturing_investigation }}</div>
                           </div>
                        </div>
                        <!-- batch_disposition -->
                        <!-- Request More Info -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="submitted by">Final Approval bY :</label>
                                <div class="static">{{ $data->completed_by_batch_disposition }}</div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="submitted on">Final Approval On :</label>
                                <div class="Date">{{ $data->completed_on_batch_disposition }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_batch_disposition }}</div>
                           </div>
                        </div>
                        <!-- Request More Info -->
                        <!-- Approval Completed -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="completed by"> Approval Completed By :</label>
                                <div class="static">{{ $data->completed_by_approval_completed }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="completed on"> Approval Completed On :</label>
                                <div class="Date">{{ $data->completed_on_approval_completed }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on"> Approval Comment</label>
                            <div class="Date">{{ $data->comment_approval_completed }}</div>
                           </div>
                        </div>
                        <!-- Cancelled By -->
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="cancelled by">Cancelled By :</label>
                                <div class="static">{{ $data->cancelled_by }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="cancelled on">Cancelled On :</label>
                                <div class="Date">{{ $data->cancelled_on }}</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="group-input">
                            <label for="Submitted on">Comment</label>
                            <div class="Date">{{ $data->comment_cancle }}</div>
                           </div>
                        </div>
                        
                    </div>

        <div class="button-block">
        @if ($data->stage == 0  || $data->stage >= 15)
        <div class="progress-bars">
                <div class="bg-danger">Workflow is already Closed-Done</div>
            </div>
        @else
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        <button type="button" class="backButton" onclick="previousStep()">Back</button>
        @endif    
        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                Exit </a> </button>
        </div>
    </div>
</div>