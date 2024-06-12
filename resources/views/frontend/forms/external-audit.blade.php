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
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Purpose & Scope</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Audit Notes</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Important Dates</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm5')">Audit Report & Response</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Reference Info/Comments</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm7')">Addendum Details</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm8')">Activity History</button>
            </div>

            <!-- General Information -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Opened">Date Opened</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Short Description">Short Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Description">Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="sub-head">
                            Audit Information
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quality Reviewer">Quality Reviewer</label>
                                <select name="assigend">
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Quality Approver">Quality Approver</label>
                                <select name="assigend">
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                    <option value="piyush">Piyush Sahu</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Plan">
                                    List Of Auditor's<button type="button" name="ann"
                                        onclick="add5Input('auditor_list')">+</button>
                                </label>
                                <table class="table table-bordered" id="auditor_list">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>External Auditor Name </th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>Auditor Type</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Plan">
                                    List Of Auditee<button type="button" name="ann"
                                        onclick="add5Input('auditee_list')">+</button>
                                </label>
                                <table class="table table-bordered" id="auditee_list">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>EA Auditee Name </th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th>Remark</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type of External Audit">Type of External Audit</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Consultant Audit</option>
                                    <option>Customer Audit</option>
                                    <option>Partner Audit</option>
                                    <option>Regulatory Audit</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Agency Customer Name">Agency Customer Name</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audited Site">Audited Site</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Report No.">Audit Report No.</label>
                                <input type="number" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Agenda Attachments">Agenda Attachment</label>
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Purpose">Purpose</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Scope">Scope</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Executive Summary">Executive Summary</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Notes">Audit Notes</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Audit Note Attachments">Audit Note Attachment</label>
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Scheduled Start Date">Scheduled Start Date</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Scheduled End Date">Scheduled End Date</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Start Date">Actual Start Date</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual End Date">Actual End Date</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Audit Report Received">Date Audit Report Received</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Response Due">Date Response Due</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Of Response Submitted">Date Of Response Submitted</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date of Executive Summary">Date of Executive Summary</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm5" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Audit Report Received">Audit Report Received</label>
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Issuance">Report Issuance</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Sent">Report Sent</label>
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response">Response</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Response Review">Response Review</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments">Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Response">Response</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attachments">Attachment</label>
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Records">Reference Records</label>
                                <input type="text" name="record">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm7" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Addendum Comments">Addendum Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Addendum Attachments">Addendum Attachment</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm8" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Actual Closure Date">Actual Closure Date</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Record Signature
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Complete Audit By">Complete Audit By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Complete Audit On">Complete Audit On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Received By">Report Received By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Report Received On">Report Received On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="No Report Received By">No Report Received By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="No Report Received On">No Report Received On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit Response for Review By">Submit Response for Review By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit Response for Review On">Submit Response for Review On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Sent By">Response Sent By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Response Sent On">Response Sent On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancel By">Cancel By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancel On">Cancel On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Addendum Complete By">Addendum Complete By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Addendum Complete On">Addendum Complete On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Re Open For Addendum By">Re Open For Addendum By</label>
                                <div class=" static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Re Open For Addendum On">Re Open For Addendum On</label>
                                <div class=" static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Cancellation Details
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Cancellation Justification">Cancellation Justification</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
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
