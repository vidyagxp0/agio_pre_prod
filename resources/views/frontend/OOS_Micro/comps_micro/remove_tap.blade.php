{{--<button class="cctablinks" onclick="openCity(event, 'CCForm13')">Under Addendum Approval</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button>--}}
                
   <!-- Under Addendum Approval -->
    <div id="CCForm13" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Addendum Approval Comment
                </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Reopen Approval Comments </label>
                            <textarea class="summernote" name="reopen_approval_comments" id="summernote-1"></textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="ua_approval_attachment"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="ua_approval_attachment[]"
                                        oninput="addMultipleFiles(this, 'ua_approval_attachment')" multiple>
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

    <!--Under Addendum Execution -->
        <div id="CCForm14" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Addendum Execution Comment
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Execution Comments</label>
                            <textarea class="summernote" name="execution_comments" id="summernote-1"></textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Action Task Required?</label>
                            <select name="action_task_required">
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="action_task_reference_no">Action Task Reference No.</label>
                            <select multiple id="reference_record" name="action_task_reference_no[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addi.Testing Req?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addi.Testing Ref.</label>
                            <select multiple id="reference_record" name="addi_testing_ref[]" id="">
                                <option value="">--Select---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Investigation Req.?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Investigation Ref.</label>
                            <select multiple id="reference_record" name="investigation_ref[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo-Exp Req?</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option>Yes</option>
                                <option>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Hypo-Exp Ref.</label>
                            <select multiple id="reference_record" name="hypo_exp_ref[]" id="">
                                <option value="">--Select---</option>
                                <option value="">1</option>
                                <option value="">2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Attachments
                            </label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="ua_Execution_attachments"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="ua_Execution_attachments[]"
                                        oninput="addMultipleFiles(this, 'ua_Execution_attachments')" multiple>
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
    <!-- Under Addendum Review-->
        <div id="CCForm15" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Under Addendum Review
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Addendum Review Comments</label>
                            <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                            <textarea class="summernote" name="addendum_review_comments" id="summernote-1">
                    </textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="group-input">
                            <label for="Reference Recores">Required Attachment</label>
                            <small class="text-primary">
                                Please Attach all relevant or supporting documents
                            </small>
                            <div class="file-attachment-field">
                                <div class="file-attachment-list" id="uar_required_attachment"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="uar_required_attachment[]"
                                        oninput="addMultipleFiles(this, 'uar_required_attachment')" multiple>
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
    <!-- Under Addendum Verification -->
        <div id="CCForm16" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Addendum Verification Comment
                </div>
                <div class="row">

                    <div class="col-md-12 mb-4">
                        <div class="group-input">
                            <label for="Description Deviation">Verification Comments </label>
                            <textarea class="summernote" name="verification_comments" id="summernote-1">
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
                                <div class="file-attachment-list" id="uav_verification_attachment"></div>
                                <div class="add-btn">
                                    <div>Add</div>
                                    <input type="file" id="myfile" name="uav_verification_attachment[]"
                                        oninput="addMultipleFiles(this, 'uav_verification_attachment')" multiple>
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
<!-- ================ on update remove tap =========================== -->
{{--<button class="cctablinks" onclick="openCity(event, 'CCForm13')">Under Addendum Approval</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm14')">Under Addendum Execution</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm15')">Under Addendum Review</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm16')">Under Addendum Verification</button>--}}
                {{--<button class="cctablinks" onclick="openCity(event, 'CCForm17')">Signature</button>--}}
 
<!-- Under Addendum Approval -->
<div id="CCForm13" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Addendum Approval Comment
        </div>
        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Reopen Approval Comments </label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
                            </textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Addendum Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attach[]"
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
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
<!--Under Addendum Execution -->
<div id="CCForm14" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Addendum Execution Comment
        </div>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Execution Comments</label>
                    <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
                    </textarea>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Action Task Required?</label>
                    <select>
                        <option>Enter Your Selection Here</option>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Action Task Reference No.</label>
                    <select multiple id="reference_record" name="refrence_record[]" id="">
                        <option value="">--Select---</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Addi.Testing Req?</label>
                    <select>
                        <option>Enter Your Selection Here</option>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Addi.Testing Ref.</label>
                    <select multiple id="reference_record" name="refrence_record[]" id="">
                        <option value="">--Select---</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Investigation Req.?</label>
                    <select>
                        <option>Enter Your Selection Here</option>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Investigation Ref.</label>
                    <select multiple id="reference_record" name="refrence_record[]" id="">
                        <option value="">--Select---</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Hypo-Exp Req?</label>
                    <select>
                        <option>Enter Your Selection Here</option>
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="group-input">
                    <label for="Reference Recores">Hypo-Exp Ref.</label>
                    <select multiple id="reference_record" name="refrence_record[]" id="">
                        <option value="">--Select---</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>
            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Addendum Attachments
                    </label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attach[]"
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
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
<!-- Under Addendum Review-->
<div id="CCForm15" class="inner-block cctabcontent">
    <div class="inner-block-content">
        <div class="sub-head">
            Under Addendum Review
        </div>
        <div class="row">

            <div class="col-md-12 mb-4">
                <div class="group-input">
                    <label for="Description Deviation">Addendum Review Comments</label>
                    <!-- <div><small class="text-primary">Please insert "NA" in the data field if it does not require completion</small></div> -->
                    <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
            </textarea>
                </div>
            </div>

            <div class="col-12">
                <div class="group-input">
                    <label for="Reference Recores">Required Attachment</label>
                    <small class="text-primary">
                        Please Attach all relevant or supporting documents
                    </small>
                    <div class="file-attachment-field">
                        <div class="file-attachment-list" id="file_attach"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attach[]"
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
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
<!-- Under Addendum Verification -->
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
                    <textarea class="summernote" name="Description_Deviation[]" id="summernote-1">
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
                        <div class="file-attachment-list" id="file_attach"></div>
                        <div class="add-btn">
                            <div>Add</div>
                            <input type="file" id="myfile" name="file_attach[]"
                                oninput="addMultipleFiles(this, 'file_attach')" multiple>
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

 <!----- Signature ----->

 <div id="CCForm17" class="inner-block cctabcontent">
            <div class="inner-block-content">
                <div class="sub-head">
                    Activity Log
                </div>
                <div class="row">

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Agenda">Preliminary Lab Inves. Done By</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Agenda">Preliminary Lab Inves. Done On</label>
                            <div class="Date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Team">Pre. Lab Inv. Conclusion By</label>
                            <div class="static"></div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Team">Pre. Lab Inv. Conclusion On</label>
                            <div class="Date"></div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="group-input">
                            <label for="Audit Comments"> Pre.Lab Invest. Review By </label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Pre.Lab Invest. Review On</label>
                            <div class="Date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase II Invest. Proposed By</label>
                            <div class="static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Phase II Invest. Proposed On</label>
                            <div class="Date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Response Completed By"> Phase II QC Review Done By</label>
                            <div class=" static"></div>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Response Completed On">Phase II QC Review Done On</label>
                            <div class="date"></div>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Additional Test Proposed By</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Additional Test Proposed On</label>
                            <div class="date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS Conclusion Complete By</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">OOS Conclusion Complete On</label>
                            <div class="date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Review Done By</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">CQ Review Done On</label>
                            <div class="date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Disposition Decision Done by</label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Audit Attachments">Disposition Decision Done On</label>
                            <div class="date"></div>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Addendum Complete By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Addendum Complete on

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Approval Completed By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Reopen Addendum Complete on

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Execution Done By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Execution Done On

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Review Done By

                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Addendum Review Done On

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Verification Review Done By
                            </label>
                            <div class=" static"></div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="Reference Recores">Verification Review Done On

                            </label>
                            <div class="date"></div>
                        </div>
                    </div>
                    <!-- ====================================================================== -->
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted by">Submitted By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="submitted on">Submitted On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="cancelled by">Cancelled By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="cancelled on">Cancelled On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="More information required By">More information required By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="More information required On">More information required On :</label>
                            <div class="Date"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="completed by">Completed By :</label>
                            <div class="static"></div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="group-input">
                            <label for="completed on">Completed On :</label>
                            <div class="Date"></div>
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
