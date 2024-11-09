<div id="CCForm17" class="inner-block cctabcontent">
    <div class="inner-block-content">
         <div class="row">
            <div class="col-12 sub-head"> Submit</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Agenda">Submit By</label>
                    @if ($data->Submite_by)
                        <div class="static">{{ $data->Submite_by }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Agenda">Submit On</label>
                    @if ($data->Submite_on)
                        <div class="static">{{ $data->Submite_on }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Submit Comment</label>
                    @if ($data->Submite_comment)
                        <div class="static">{{ $data->Submite_comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-12 sub-head">Request for Cancellation</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="cancelled by">Request for Cancellation By</label>
                    @if ($data->cancelled_by)
                        <div class="static">{{ $data->cancelled_by }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="cancelled on">Request for Cancellation On</label>
                    @if ($data->cancelled_on)
                        <div class="static">{{ $data->cancelled_on }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Request for Cancellation Comment</label>
                    @if ($data->comment_cancle)
                        <div class="static">{{ $data->comment_cancle }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        <div>
        <div class="row">
        <div class="col-12 sub-head">HOD Primary Review Complete</div>
         <!-- Request More Info -->
            <!--  Initial Phase I Investigation  Done By -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Team">HOD Primary Review Complete By</label>
                    @if ($data->HOD_Primary_Review_Complete_By)
                        <div class="static">{{ $data->HOD_Primary_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Team">HOD Primary Review Complete On</label>
                    @if ($data->HOD_Primary_Review_Complete_On)
                        <div class="static">{{ $data->HOD_Primary_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">HOD Primary Review Complete Comment</label>
                     @if ($data->HOD_Primary_Review_Complete_Comment)
                        <div class="static">{{ $data->HOD_Primary_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-12 sub-head">  Cancel </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="cancelled by">Cancel By</label>
                    @if ($data->cancelled_by)
                        <div class="static">{{ $data->cancelled_by }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="cancelled on">Cancel On</label>
                    @if ($data->cancelled_on)
                        <div class="static">{{ $data->cancelled_on }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Cancel Comment</label>
                    @if ($data->comment_cancle)
                        <div class="static">{{ $data->comment_cancle }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">QA/CQA Head Primary Review Complete</div>
            <!-- Request More Info -->
            <!-- Assignable Cause Found -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Comments">QA/CQA Head Primary Review Complete By</label>
                    @if ($data->CQA_Head_Primary_Review_Complete_By)
                        <div class="static">{{ $data->CQA_Head_Primary_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">QA/CQA Head Primary Review Complete On</label>
                    @if ($data->CQA_Head_Primary_Review_Complete_On)
                        <div class="static">{{ $data->CQA_Head_Primary_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">QA/CQA Head Primary Review Complete Comment</label>
                    @if ($data->CQA_Head_Primary_Review_Complete_Comment)
                        <div class="static">{{ $data->CQA_Head_Primary_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Assignable Cause Not Found -->
            <div class="col-12 sub-head">Phase IA Investigation</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA Investigation By</label>
                    @if ($data->Phase_IA_Investigation_By)
                        <div class="static">{{ $data->Phase_IA_Investigation_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA Investigation On</label>
                    @if ($data->Phase_IA_Investiigation_On)
                        <div class="static">{{ $data->Phase_IA_Investiigation_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IA Investigation Comment</label>
                    @if ($data->Phase_IA_Investigation_Comment)
                        <div class="static">{{ $data->Phase_IA_Investigation_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">Phase IA HOD Review Complete</div>
             <!-- Request More Info -->
            <!-- Correction Completed -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA HOD Review Complete By</label>
                    @if ($data->Phase_IA_HOD_Review_Complete_By)
                        <div class="static">{{ $data->Phase_IA_HOD_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA HOD Review Complete On</label>
                    @if ($data->Phase_IA_HOD_Review_Complete_On)
                        <div class="static">{{ $data->Phase_IA_HOD_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IA HOD Review Complete Comment</label>
                    @if ($data->Phase_IA_HOD_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_IA_HOD_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Proposed Hypothesis Experiment -->
            <div class="col-12 sub-head">Phase IA QA/CQA Review Complete</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Response Completed By"> Phase IA QA/CQA Review Complete By</label>
                    @if ($data->Phase_IA_QA_Review_Complete_By)
                        <div class="static">{{ $data->Phase_IA_QA_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Response Completed On">Phase IA QA/CQA Review Complete On</label>
                    @if ($data->Phase_IA_QA_Review_Complete_On)
                        <div class="static">{{ $data->Phase_IA_QA_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IA QA/CQA Review Complete Comment</label>
                    @if ($data->Phase_IA_QA_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_IA_QA_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- Obvious Error Found -->
            <div class="col-12 sub-head">Assignable Cause Found</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Not Found By</label>
                    @if ($data->Assignable_Cause_Not_Found_By)
                        <div class="static">{{ $data->Assignable_Cause_Not_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Not Found On</label>
                    @if ($data->Assignable_Cause_Not_Found_On)
                        <div class="static">{{ $data->Assignable_Cause_Not_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Assignable Cause Not Found Comment</label>
                    @if ($data->Assignable_Cause_Not_Found_Comment)
                        <div class="static">{{ $data->Assignable_Cause_Not_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- No Assignable Cause Found -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Found By</label>
                    @if ($data->Assignable_Cause_Found_By)
                        <div class="static">{{ $data->Assignable_Cause_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Found On</label>
                    @if ($data->Assignable_Cause_Found_On)
                        <div class="static">{{ $data->Assignable_Cause_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Assignable Cause Found Comment</label>
                    @if ($data->Assignable_Cause_Found_Comment)
                        <div class="static">{{ $data->Assignable_Cause_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">Phase IB Investigation</div>
            <!-- Request More Info -->
            <!-- Repeat Analysis Completed -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB Investigation By</label>
                    @if ($data->Phase_IB_Investigation_By)
                        <div class="static">{{ $data->Phase_IB_Investigation_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB Investigation On</label>
                    @if ($data->Phase_IB_Investigation_On)
                        <div class="static">{{ $data->Phase_IB_Investigation_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IB Investigation Comment</label>
                    @if ($data->Phase_IB_Investigation_Comment)
                        <div class="static">{{ $data->Phase_IB_Investigation_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Full Scale Investigation -->
            <div class="col-12 sub-head">Phase IB HOD Review Complete</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB HOD Review Complete by</label>
                    @if ($data->Phase_IB_HOD_Review_Complete_By)
                        <div class="static">{{ $data->Phase_IB_HOD_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB HOD Review Complete On</label>
                    @if ($data->Phase_IB_HOD_Review_Complete_On)
                        <div class="static">{{ $data->Phase_IB_HOD_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IB HOD Review Complete Comment</label>
                    @if ($data->Phase_IB_HOD_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_IB_HOD_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">Phase IB QA/CQA Review Complete</div>
            <!-- Request More Info -->
            <!-- Assignable Cause Found (Manufacturing Defect) -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase IB QA/CQA Review Complete By</label>
                    @if ($data->Phase_IB_QA_Review_Complete_By)
                        <div class="static">{{ $data->Phase_IB_QA_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase IB QA/CQA Review Complete On </label>
                    @if ($data->Phase_IB_QA_Review_Complete_On)
                        <div class="static">{{ $data->Phase_IB_QA_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IB QA/CQA Review Complete Comment</label>
                    @if ($data->Phase_IB_QA_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_IB_QA_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- No Assignable Cause Found (No Manufacturing Defect) -->
            <div class="col-12 sub-head">CQA/QA Head/Designee</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-IB Assignable Cause Not Found By</label>
                    @if ($data->P_I_B_Assignable_Cause_Not_Found_By)
                        <div class="static">{{ $data->P_I_B_Assignable_Cause_Not_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-IB Assignable Cause Not Found On </label>
                    @if ($data->P_I_B_Assignable_Cause_Not_Found_On)
                        <div class="static">{{ $data->P_I_B_Assignable_Cause_Not_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-IB Assignable Cause Not Found Comment</label>
                    @if ($data->P_I_B_Assignable_Cause_Not_Found_Comment)
                        <div class="static">{{ $data->P_I_B_Assignable_Cause_Not_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
             <!-- Request More Info -->
             <!-- Phase II Correction Completed  -->
            
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-IB Assignable Cause Found By</label>
                    @if ($data->P_I_B_Assignable_Cause_Found_By)
                        <div class="static">{{ $data->P_I_B_Assignable_Cause_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-IB Assignable Cause Found On</label>
                    @if ($data->P_I_B_Assignable_Cause_Found_On)
                        <div class="static">{{ $data->P_I_B_Assignable_Cause_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-IB Assignable Cause Found Comment</label>
                    @if ($data->P_I_B_Assignable_Cause_Found_Comment)
                        <div class="static">{{ $data->P_I_B_Assignable_Cause_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        
             <!--  Phase II A Correction Inconclusive -->
             <div class="col-12 sub-head">Phase II A Investigation</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A Investigation By</label>
                    @if ($data->Phase_II_A_Investigation_By)
                        <div class="static">{{ $data->Phase_II_A_Investigation_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A Investigation On</label>
                    @if ($data->Phase_II_A_Investigation_On)
                        <div class="static">{{ $data->Phase_II_A_Investigation_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II A Investigation Comment</label>
                    @if ($data->Phase_II_A_Investigation_Comment)
                        <div class="static">{{ $data->Phase_II_A_Investigation_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
       
            <!-- Request More Info -->
             <!-- Retesting/resampling -->
             <div class="col-12 sub-head">Phase II A HOD Review Complete</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A HOD Review Complete By </label>
                    @if ($data->Phase_II_A_HOD_Review_Complete_By)
                        <div class="static">{{ $data->Phase_II_A_HOD_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A HOD Review Complete On </label>
                    @if ($data->Phase_II_A_HOD_Review_Complete_On)
                        <div class="static">{{ $data->Phase_II_A_HOD_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II A HOD Review Complete Comment</label>
                    @if ($data->Phase_II_A_HOD_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_II_A_HOD_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        
            <!-- Phase II B Correction Inconclusive -->
            <div class="col-12 sub-head">Phase II A QA/CQA Review Complete</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A QA/CQA Review Complete By </label>
                    @if ($data->Phase_II_A_QA_Review_Complete_By)
                        <div class="static">{{ $data->Phase_II_A_QA_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A QA/CQA Review Complete On </label>
                    @if ($data->Phase_II_A_QA_Review_Complete_On)
                        <div class="static">{{ $data->Phase_II_A_QA_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II A QA/CQA Review Complete Comment</label>
                    @if ($data->Phase_II_A_QA_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_II_A_QA_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">CQA/QA Head/Designee</div>
            <!-- Final Approval -->
            <!-- Request More Info -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="submitted by">P-II A Assignable Cause Not Found By</label>
                    @if ($data->P_II_A_Assignable_Cause_Not_Found_By)
                        <div class="static">{{ $data->P_II_A_Assignable_Cause_Not_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="submitted on">P-II A Assignable Cause Not Found On</label>
                    @if ($data->P_II_A_Assignable_Cause_Not_Found_On)
                        <div class="static">{{ $data->P_II_A_Assignable_Cause_Not_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II A Assignable Cause Not Found Comment</label>
                    @if ($data->P_II_A_Assignable_Cause_Not_Found_Comment)
                        <div class="static">{{ $data->P_II_A_Assignable_Cause_Not_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Approval Completed -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by"> P-II A Assignable Cause Found By</label>
                    @if ($data->P_II_A_Assignable_Cause_Found_By)
                        <div class="static">{{ $data->P_II_A_Assignable_Cause_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> P-II A Assignable Cause Found On</label>
                    @if ($data->P_II_A_Assignable_Cause_Found_On)
                        <div class="static">{{ $data->P_II_A_Assignable_Cause_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II A Assignable Cause Found Comment</label>
                    @if ($data->P_II_A_Assignable_Cause_Found_Comment)
                        <div class="static">{{ $data->P_II_A_Assignable_Cause_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-12 sub-head">Phase II B Investigation</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by"> Phase II B Investigation By</label>
                    @if ($data->Phase_II_B_Investigation_By)
                        <div class="static">{{ $data->Phase_II_B_Investigation_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> Phase II B Investigation On</label>
                    @if ($data->Phase_II_B_Investigation_On)
                        <div class="static">{{ $data->Phase_II_B_Investigation_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II B Investigation Comment</label>
                    @if ($data->Phase_II_B_Investigation_Comment)
                        <div class="static">{{ $data->Phase_II_B_Investigation_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-12 sub-head">Phase II B HOD Review Complete</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by"> Phase II B HOD Review Complete By</label>
                    @if ($data->Phase_II_B_HOD_Review_Complete_By)
                        <div class="static">{{ $data->Phase_II_B_HOD_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> Phase II B HOD Review Complete On</label>
                    @if ($data->Phase_II_B_HOD_Review_Complete_On)
                        <div class="static">{{ $data->Phase_II_B_HOD_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II B HOD Review Complete Comment</label>
                    @if ($data->Phase_II_B_HOD_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_II_B_HOD_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-12 sub-head">Phase II B QA/CQA Review Complete</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">Phase II B QA/CQA Review Complete By</label>
                    @if ($data->Phase_II_B_QA_Review_Complete_By)
                        <div class="static">{{ $data->Phase_II_B_QA_Review_Complete_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> Phase II B QA/CQA Review Complete On</label>
                    @if ($data->Phase_II_B_QA_Review_Complete_On)
                        <div class="static">{{ $data->Phase_II_B_QA_Review_Complete_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II B QA/CQA Review Complete Comment</label>
                    @if ($data->Phase_II_B_QA_Review_Complete_Comment)
                        <div class="static">{{ $data->Phase_II_B_QA_Review_Complete_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-12 sub-head">P-II B Assignable Cause Found</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">P-II B Assignable Cause Not Found By</label>
                    @if ($data->P_II_B_Assignable_Cause_Not_Found_By)
                        <div class="static">{{ $data->P_II_B_Assignable_Cause_Not_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on">P-II B Assignable Cause Not Found On</label>
                    @if ($data->P_II_B_Assignable_Cause_Not_Found_On)
                        <div class="static">{{ $data->P_II_B_Assignable_Cause_Not_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II B Assignable Cause Not Found Comment</label>
                    @if ($data->P_II_B_Assignable_Cause_Not_Found_Comment)
                        <div class="static">{{ $data->P_II_B_Assignable_Cause_Not_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">P-II B Assignable Cause Found By</label>
                    @if ($data->P_II_B_Assignable_Cause_Found_By)
                        <div class="static">{{ $data->P_II_B_Assignable_Cause_Found_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on">P-II B Assignable Cause Found On</label>
                    @if ($data->P_II_B_Assignable_Cause_Found_On)
                        <div class="static">{{ $data->P_II_B_Assignable_Cause_Found_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II B Assignable Cause Found Comment</label>
                    @if ($data->P_II_B_Assignable_Cause_Found_Comment)
                        <div class="static">{{ $data->P_II_B_Assignable_Cause_Found_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>

            <div class="col-12 sub-head">P III Investigation Applicable/Not Applicable</div>

            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">P III Investigation Applicable/Not Applicable By</label>
                    @if ($data->P_III_Investigation_Applicable_By)
                        <div class="static">{{ $data->P_III_Investigation_Applicable_By }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on">P III Investigation Applicable/Not Applicable On</label>
                    @if ($data->P_III_Investigation_Applicable_On)
                        <div class="static">{{ $data->P_III_Investigation_Applicable_On }}</div>
                    @else
                        Not Applicable
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P III Investigation Applicable/Not Applicable Comment</label>
                    @if ($data->P_III_Investigation_Applicable_Comment)
                        <div class="static">{{ $data->P_III_Investigation_Applicable_Comment }}</div>
                    @else
                        Not Applicable
                    @endif
               </div>
            </div>
        </div>
        <div class="button-block">
            @if ($data->stage == 0  || $data->stage >= 21 || $data->stage >= 23 || $data->stage >= 24 || $data->stage >= 25)
            
            @else
            <button type="submit" class="saveButton">Save</button>
            <button type="button" class="backButton" onclick="previousStep()">Back</button>
            @endif
            <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white" >Exit </a> </button>
        </div>
    </div>
</div>