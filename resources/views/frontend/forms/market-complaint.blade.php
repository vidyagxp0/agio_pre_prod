@extends('frontend.layout.main')
@section('container')
<style>
    textarea.note-codable {
        display: none !important;
    }

    header {
        display: none;
    }
</style>

<div class="form-field-head">
    <div class="pr-id">
        New Document
    </div>
    <div class="division-bar">
        <strong>Site Division/Project</strong> :
        QMS-North America / CAPA
    </div>
    <div class="button-bar">
        <button type="button">Save</button>
        <button type="button">Cancel</button>
        <button type="button">New</button>
        <button type="button">Copy</button>
        <button type="button">Child</button>
        <button type="button">Check Spelling</button>
        <button type="button">Change Project</button>
    </div>
</div>





    {{-- ======================================
                    DATA FIELDS
    ======================================= --}}
    <div id="change-control-fields">
        <div class="container-fluid">

            <!-- Tab links -->
            <div class="cctab">
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">General Information</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Market Complaint Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Complaint Details (for CRS)</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Investigation Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">CAPA Plan</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Approval</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Market Complaint Response</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm9')">Market Complain Closure</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm10')">Activity Log</button>

            </div>

            <!-- General information content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="RLS Record Number">RLS Record Number</label>
                                <div class="static"> Auto Number</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Division Code">Division Code</label>
                                <div class="static">Divition Name Auto Select</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Initiator">Initiator</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Due">Date of Initiation</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date of Receipt">Date of Receipt</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Initiator Group">Initiator Group</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Complaint Acknowledgment">Complaint Acknowledgment</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    <option>N/App</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Short Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Due Date">Due Date</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned to">Assigned to</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Market Complaint Details content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Investigator">Lead Investigator</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Complaint Received From">Complaint Received From</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Distributor</option>
                                    <option>Customer</option>
                                    <option>Regulatory </option>
                                    <option>Doctors</option>
                                    <option>Hospital</option>
                                    <option>Patients</option>
                                    <option>Vendors</option>
                                    <option>Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product Details">
                                    Product Information<button type="button" name="ann"
                                        onclick="add7Input('prod_information')">+</button>
                                </label>
                                <table class="table table-bordered" id="prod_information">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Product Name</th>
                                            <th>Batch No.</th>
                                            <th>Date Of Manufacturing</th>
                                            <th>Date Of Expiry/Retest</th>
                                            <th>Dispatch Quantity</th>
                                            <th>Dispatch Date</th>
                                            <th>Material Dispatch To</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="If Others">If Others</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Name & Address Of Compplainant">Name & Address Of Complaint</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Complaint Description">Complaint Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Classification of Complaint">Classification of Complaint</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Nature of Complaint">Nature of Complaint</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Adverse Drug Reaction</option>
                                    <option>General Complaint</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Is Complaint Sample REceived">Is Complaint Sample Received</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                    <option>N/App</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quantity of Sample Receivsd">Quantity of Sample Receivsd</label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date of Sample Receipt">Date of Sample Receipt</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Record">Reference Record</label>
                                <div class="static">Ref.Record</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Remarks">Remarks</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Review Comments">Review Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="notify To">Notify To</label>
                                <select multiple name="notify_to" placeholder="Select Nature of Deviation"
                                    data-search="false" data-silent-initial-value-set="true" id="notify_to">
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                    <option value="Piyush">Piyush Sahu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attachments">Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Immediate Action">Immediate Action</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Complaint Details content -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12 sub-head">
                            Complaint Details (for CRS)
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Is it Project/Study Complaint">Is it Project/Study Complaint"</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type Of Complaint">Type Of Complaint</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Technical</option>
                                    <option>Non-Technical</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="project No/Study No">Project No/Study No</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Investigation Details content -->
            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product Details">
                                    Sample Details<button type="button" name="ann"
                                        onclick="add4Input('sample_details')">+</button>
                                </label>
                                <table class="table table-bordered" id="sample_details">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Sample Name</th>
                                            <th>Sample Batch No.</th>
                                            <th>Sample Mfg.Date</th>
                                            <th>Sample Expiry/Retest</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments">Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Investigation Attachments">Investigation Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Rood Cause Details
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Rood Cause Identification">Rood Cause Identification</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Token">Action Token</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Risk Assessment content -->
            <div id="CCForm5" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <h3>Individual Risk Assessment</h3>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product Details">
                                    Risk Assessment<button type="button" name="ann"
                                        onclick="add8Input('risk_assessment')">+</button>
                                </label>
                                <table class="table table-bordered" id="risk_assessment">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Identification of Risk</th>
                                            <th>Existing Control</th>
                                            <th>Severity(S)</th>
                                            <th>Occurance(O)</th>
                                            <th>Detection(D)</th>
                                            <th>RPN(S*O*D)</th>
                                            <th>Evaluation Of Risk</th>
                                            <th>Mitigation Plan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Overall Risk Assesment
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Risk Identification">Risk Identification</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Severity Rate">Severity Rate</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Negligible</option>
                                    <option>Negligible</option>
                                    <option>Moderate</option>
                                    <option>Major</option>
                                    <option>Fatal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Occurrence">Occurrence</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Extremely Unlikely</option>
                                    <option>Rare</option>
                                    <option>Unlikely</option>
                                    <option>Likely</option>
                                    <option>Very Likely</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Detection">Detection</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Impossible</option>
                                    <option>Rare</option>
                                    <option>Unlikely</option>
                                    <option>Likely</option>
                                    <option>Very Likely</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="RPN">RPN</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Risk Evaluation">Risk Evaluation</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Mitigation Action">Mitigation Action</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CAPA plan content -->
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Currective Action">Currective Action</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Preventive Action">Preventive Action</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="CAPA Attachments">CAPA Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval content -->
            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Approval Comments">Approval Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Market Complaint Response content -->
            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12 sub-head">
                            Response Submission
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Submitted To">Response Submitted To</label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Submitted By">Response Submitted By</label>
                                <input type="text" name="String">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Submitted Date">Response Submitted Date</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Attachments">Response Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Response Comments">Response Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Response Feedback
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Feedback Receive Date">Response Feedback Receive Date</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Feedback Attachments">Feedback Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="group-input">
                            <label for="Complainant Feedback">Complainant Feedback</label>
                            <select>
                                <option>Enter Your Selection Here</option>
                                <option></option>
                                <option></option>
                                <option></option>
                                <option></option>
                                <option></option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Response Feedback Comments">Response Feedback Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Add.Investigation & CAPA
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Add.Investigation Details">Add.Investigation Details</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Add.Investigation Attachments">Add.Investigation Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Add.Investigation Comments">Add.Investigation Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Add.Currective Action">Add.Currective Action</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Add.Preventive Action">Add.Preventive Action</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- market Complaint Closure content -->
            <div id="CCForm9" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Review & Approval Comments">Review & Approval Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Closure Attachments">Closure Attachment</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Log content -->
            <div id="CCForm10" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted By">Submitted By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted On">Submitted On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="More information Required By">More information Required By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="More information Required On">More information Required On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancelled By">Cancelled By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancelled On">Cancelled On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Investigation Completed By">Investigation Completed By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Investigation Completed On">Investigation Completed On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Inv.More Info Reqd By">Lead Inv.More Info Reqd By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Lead Inv.More Info Reqd On">Lead Inv.More Info Reqd On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="CAPA Submitted By">CAPA Submitted By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="CAPA Submitted On">CAPA Submitted On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approval Submitted By">Approval Submitted By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approval Submitted On">Approval Submitted On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QAH/Desig More Info Required By">QAH/Desig More Info Required By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QAH/Desig More Info Required On">QAH/Desig More Info Required On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit Response By">Submit Response By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit Response On">Submit Response On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Not Satisfactory Response By">Not Satisfactory Response By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Not Satisfactory Response On">Not Satisfactory Response On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Satisfactory Response By">Satisfactory Response By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Satisfactory Response On">Satisfactory Response On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Investigation & CAPA Submitted By">Investigation & CAPA Submitted
                                    By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Investigation & CAPA Submitted On">Investigation & CAPA Submitted
                                    On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved By">Approved By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved On">Approved On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA HD/Desig More Info Reqd By">QA HD/Desig More Info Reqd By</label>
                                <div class="static">Person datafield</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="QA HD/Desig More Info Reqd On">QA HD/Desig More Info Reqd On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="CCForm2" class="inner-block cctabcontent">
                <h3>Paris</h3>
                <p>Paris is the capital of France.</p>
            </div>

            <div id="CCForm3" class="inner-block cctabcontent">
                <h3>Tokyo</h3>
                <p>Tokyo is the capital of Japan.</p>
            </div>

        </div>
    </div>

    <script>
        VirtualSelect.init({
            ele: '#notify_to'
        });

        function openCity(evt, cityName) {
            var i, cctabcontent, cctablinks;
            cctabcontent = document.getElementsByClassName("cctabcontent");
            for (i = 0; i < cctabcontent.length; i++) {
                cctabcontent[i].style.display = "none";
            }
            cctablinks = document.getElementsByClassName("cctablinks");
            for (i = 0; i < cctablinks.length; i++) {
                cctablinks[i].className = cctablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
@endsection
