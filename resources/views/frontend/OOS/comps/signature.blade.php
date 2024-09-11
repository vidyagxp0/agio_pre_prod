<div id="CCForm17" class="inner-block cctabcontent">
    <div class="inner-block-content">
         <center><div class="sub-head">Activity Log</div></center>
         <div class="row">
            <div class="col-12 sub-head">  Initiator </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Agenda">Submited by</label>
                    <div class="static">{{ $data->Submite_by }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Agenda">Submited on</label>
                    <div class="Date">{{ $data->Submite_on }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Comment</label>
                <div class="Date">{{ $data->Submite_comment }}</div>
               </div>
            </div>
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
        <div>
        <div class="row">
        <div class="col-12 sub-head">HOD/Designee</div>
         <!-- Request More Info -->
            <!--  Initial Phase I Investigation  Done By -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Team">HOD Primary Review Complete By</label>
                    <div class="static">{{ $data->HOD_Primary_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Team">HOD Primary Review Complete On</label>
                    <div class="Date">{{ $data->HOD_Primary_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">HOD Primary Review Complete Comment</label>
                <div class="Date">{{ $data->HOD_Primary_Review_Complete_Comment }}</div>
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">QC Head/Designee </div>
            <!-- Request More Info -->
            <!-- Assignable Cause Found -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Comments">QA/CQA Head Primary Review Complete By</label>
                    <div class="static">{{ $data->CQA_Head_Primary_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">QA/CQA Head Primary Review Complete On</label>
                    <div class="Date">{{ $data->CQA_Head_Primary_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">QA/CQA Head Primary Review Complete Comment</label>
                <div class="Date">{{ $data->CQA_Head_Primary_Review_Complete_Comment }}</div>
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Assignable Cause Not Found -->
            <div class="col-12 sub-head">Initiator</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA Investigation By</label>
                    <div class="static">{{ $data->Phase_IA_Investigation_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA Investigation On</label>
                    <div class="Date">{{ $data->Phase_IA_Investiigation_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IA Investigation Comment</label>
                <div class="Date">{{ $data->Phase_IA_Investigation_Comment }}</div>
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">HOD/Designee</div>
             <!-- Request More Info -->
            <!-- Correction Completed -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA HOD Review Complete By</label>
                    <div class="static">{{ $data->Phase_IA_HOD_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IA HOD Review Complete On</label>
                    <div class="Date">{{ $data->Phase_IA_HOD_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IA HOD Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_IA_HOD_Review_Complete_Comment }}</div>
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Proposed Hypothesis Experiment -->
            <div class="col-12 sub-head">QA/CQA</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Response Completed By"> Phase IA QA/CQA Review Complete By</label>
                    <div class=" static">{{ $data->Phase_IA_QA_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Response Completed On">Phase IA QA/CQA Review Complete On</label>
                    <div class="date">{{ $data->Phase_IA_QA_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IA QA/CQA Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_IA_QA_Review_Complete_Comment }}</div>
               </div>
            </div>
            <!-- Obvious Error Found -->
            <div class="col-12 sub-head">CQA/QA Head/Designee</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Not Found By</label>
                    <div class=" static">{{ $data->Assignable_Cause_Not_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Not Found On</label>
                    <div class="date">{{ $data->Assignable_Cause_Not_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Assignable Cause Not Found Comment</label>
                <div class="Date">{{ $data->Assignable_Cause_Not_Found_Comment }}</div>
               </div>
            </div>
            <!-- No Assignable Cause Found -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Found By</label>
                    <div class=" static">{{ $data->Assignable_Cause_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Assignable Cause Found On</label>
                    <div class="date">{{ $data->Assignable_Cause_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Assignable Cause Found Comment</label>
                <div class="Date">{{ $data->Assignable_Cause_Found_Comment }}</div>
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">Initiator</div>
            <!-- Request More Info -->
            <!-- Repeat Analysis Completed -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB Investigation By</label>
                    <div class=" static">{{ $data->Phase_IB_Investigation_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB Investigation On</label>
                    <div class="date">{{ $data->Phase_IB_Investigation_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IB Investigation Comment</label>
                <div class="Date">{{ $data->Phase_IB_Investigation_Comment }}</div>
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Full Scale Investigation -->
            <div class="col-12 sub-head">HOD/Designee</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB HOD Review Complete by</label>
                    <div class=" static">{{ $data->Phase_IB_HOD_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Audit Attachments">Phase IB HOD Review Complete On</label>
                    <div class="date">{{ $data->Phase_IB_HOD_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IB HOD Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_IB_HOD_Review_Complete_Comment }}</div>
               </div>
            </div>
        <div>
        <div class="row">
            <div class="col-12 sub-head">QA/CQA</div>
            <!-- Request More Info -->
            <!-- Assignable Cause Found (Manufacturing Defect) -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase IB QA/CQA Review Complete By</label>
                    <div class=" static">{{ $data->Phase_IB_QA_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase IB QA/CQA Review Complete On </label>
                    <div class="date">{{ $data->Phase_IB_QA_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase IB QA/CQA Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_IB_QA_Review_Complete_Comment }}</div>
               </div>
            </div>
            <!-- No Assignable Cause Found (No Manufacturing Defect) -->
            <div class="col-12 sub-head">CQA/QA Head/Designee</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-I B Assignable Cause Not Found By</label>
                    <div class=" static">{{ $data->P_I_B_Assignable_Cause_Not_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-I B Assignable Cause Not Found On </label>
                    <div class="date">{{ $data->P_I_B_Assignable_Cause_Not_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-I B Assignable Cause Not Found Comment</label>
                <div class="Date">{{ $data->P_I_B_Assignable_Cause_Not_Found_Comment }}</div>
               </div>
            </div>
             <!-- Request More Info -->
             <!-- Phase II Correction Completed  -->
            
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-I B Assignable Cause Found By</label>
                    <div class="static">{{ $data->P_I_B_Assignable_Cause_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">P-I B Assignable Cause Found On</label>
                    <div class="date">{{ $data->P_I_B_Assignable_Cause_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-I B Assignable Cause Found Comment</label>
                <div class="Date">{{ $data->P_I_B_Assignable_Cause_Found_Comment }}</div>
               </div>
            </div>
        
             <!--  Phase II A Correction Inconclusive -->
             <div class="col-12 sub-head">Production</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A Investigation By</label>
                    <div class=" static">{{ $data->Phase_II_A_Investigation_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A Investigation On</label>
                    <div class="date">{{ $data->Phase_II_A_Investigation_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II A Investigation Comment</label>
                <div class="Date">{{ $data->Phase_II_A_Investigation_Comment }}</div>
               </div>
            </div>
       
            <!-- Request More Info -->
             <!-- Retesting/resampling -->
             <div class="col-12 sub-head">Production Head</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A HOD Review Complete By </label>
                    <div class=" static">{{ $data->Phase_II_A_HOD_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A HOD Review Complete On </label>
                    <div class="date">{{ $data->Phase_II_A_HOD_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II A HOD Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_II_A_HOD_Review_Complete_Comment }}</div>
               </div>
            </div>
        
            <!-- Phase II B Correction Inconclusive -->
            <div class="col-12 sub-head">QA/CQA</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A QA/CQA Review Complete By </label>
                    <div class=" static">{{ $data->Phase_II_A_QA_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="Reference Recores">Phase II A QA/CQA Review Complete On </label>
                    <div class="date">{{ $data->Phase_II_A_QA_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II A QA/CQA Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_II_A_QA_Review_Complete_Comment }}</div>
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
                    <div class="static">{{ $data->P_II_A_Assignable_Cause_Not_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="submitted on">P-II A Assignable Cause Not Found On</label>
                    <div class="Date">{{ $data->P_II_A_Assignable_Cause_Not_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II A Assignable Cause Not Found Comment</label>
                <div class="Date">{{ $data->P_II_A_Assignable_Cause_Not_Found_Comment }}</div>
               </div>
            </div>
            <!-- Request More Info -->
            <!-- Approval Completed -->
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by"> P-II A Assignable Cause Found By</label>
                    <div class="static">{{ $data->P_II_A_Assignable_Cause_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> P-II A Assignable Cause Found On</label>
                    <div class="Date">{{ $data->P_II_A_Assignable_Cause_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II A Assignable Cause Found Comment</label>
                <div class="Date">{{ $data->P_II_A_Assignable_Cause_Found_Comment }}</div>
               </div>
            </div>
            <div class="col-12 sub-head">Initiator</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by"> Phase II B Investigation By</label>
                    <div class="static">{{ $data->Phase_II_B_Investigation_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> Phase II B Investigation On</label>
                    <div class="Date">{{ $data->Phase_II_B_Investigation_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II B Investigation Comment</label>
                <div class="Date">{{ $data->Phase_II_B_Investigation_Comment }}</div>
               </div>
            </div>
            <div class="col-12 sub-head">HOD/Designee</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by"> Phase II B HOD Review Complete By</label>
                    <div class="static">{{ $data->Phase_II_B_HOD_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> Phase II B HOD Review Complete On</label>
                    <div class="Date">{{ $data->Phase_II_B_HOD_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II B HOD Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_II_B_HOD_Review_Complete_Comment }}</div>
               </div>
            </div>
            <div class="col-12 sub-head">QA/CQA</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">Phase II B QA/CQA Review Complete By</label>
                    <div class="static">{{ $data->Phase_II_B_QA_Review_Complete_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on"> Phase II B QA/CQA Review Complete On</label>
                    <div class="Date">{{ $data->Phase_II_B_QA_Review_Complete_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">Phase II B QA/CQA Review Complete Comment</label>
                <div class="Date">{{ $data->Phase_II_B_QA_Review_Complete_Comment }}</div>
               </div>
            </div>
            <div class="col-12 sub-head">CQA/QA Head /Designee</div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">P-II B Assignable Cause Not Found By</label>
                    <div class="static">{{ $data->P_II_B_Assignable_Cause_Not_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on">P-II B Assignable Cause Not Found On</label>
                    <div class="Date">{{ $data->P_II_B_Assignable_Cause_Not_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II B Assignable Cause Not Found Comment</label>
                <div class="Date">{{ $data->P_II_B_Assignable_Cause_Not_Found_Comment }}</div>
               </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed by">P-II B Assignable Cause Found By</label>
                    <div class="static">{{ $data->P_II_B_Assignable_Cause_Found_By }}</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="group-input">
                    <label for="completed on">P-II B Assignable Cause Found On</label>
                    <div class="Date">{{ $data->P_II_B_Assignable_Cause_Found_On }}</div>
                </div>
            </div>
            <div class="col-lg-4">
               <div class="group-input">
                <label for="Submitted on">P-II B Assignable Cause Found Comment</label>
                <div class="Date">{{ $data->P_II_B_Assignable_Cause_Found_Comment }}</div>
               </div>
            </div>
        </div>

        <div class="button-block">
        <button type="submit" id="ChangesaveButton" class="saveButton">Save</button>
        <button type="button" class="backButton" onclick="previousStep()">Back</button>
        <button type="button"> <a href="{{ url('rcms/qms-dashboard') }}" class="text-white">
                Exit </a> </button>
        </div>
    </div>
</div>