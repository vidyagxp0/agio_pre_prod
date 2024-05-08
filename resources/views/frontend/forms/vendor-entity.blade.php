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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">
                    General Information
                </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">
                    Reference Info/Comments
                </button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">
                    Activity History
                </button>
            </div>

            <!-- General Information -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Opened">Date Opened</label>
                                <div class="static">17-04-2023 11:12PM</div>
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
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Quality Reviewer"><b>Quality Reviewer</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Quality Approver"><b>Quality Approver</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Supervisor/Manager"><b>Supervisor/Manager</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Vendor Information
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Vendor Division"><b>Vendor Division</b></label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Material Group</option>
                                    <option>Service Group</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="New/Exiting Vendor"><b>New/Exiting Vendor</b></label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>New Vendor</option>
                                    <option>Exiting Vendor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Vendor Name">Vendor Name</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Office Address">Office Address</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Vendor Country"><b>Vendor Country</b></label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>India</option>
                                    <option>USA</option>
                                    <option>Brazil</option>
                                    <option>China</option>
                                    <option>Utd.Arab Emir.</option>
                                    <option>Argentina</option>
                                    <option>Austria</option>
                                    <option>Australia</option>
                                    <option>Bosnia-Herz.</option>
                                    <option>Belgium</option>
                                    <option>Bulgaria</option>
                                    <option>Brunei Daruss</option>
                                    <option>Belarus</option>
                                    <option>Canada</option>
                                    <option>Switzerland</option>
                                    <option>Chile</option>
                                    <option>Colombia</option>
                                    <option>Cuba</option>
                                    <option>Cyprus</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Vendor Website">Vendor Website</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Vendor Logo"><b>Vendor Logo</b></label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="No. Of Vendor Site">No. Of Vendor Site</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product Details">
                                    Contact Persons<button type="button" name="ann"
                                        onclick="add3Input('contact-persons')">+</button>
                                </label>
                                <table class="table table-bordered" id="contact-persons">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Contact Name</th>
                                            <th>Contact Number</th>
                                            <th>Contact Email ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Biocon Biologics Products">Biocon Biologics Products</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Biocon Biologics Site">Biocon Biologics Site</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Vendor Basic document"><b>Vendor Basic document</b></label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Inactive Justification">Inactive Justification</label>
                                <input type="text" name="title" />
                            </div>
                        </div>
                        <div class="col-12 sub-head">
                            Vendor Notes
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Inactive Notes">Inactive Notes</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <!-- Reference Info comments -->
                        <div class="col-12 sub-head">
                            Reference Info Comments
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments"><b>Comments</b></label>
                                <textarea name="title"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attachments"><b>Attachment</b></label>
                                <input type="file" id="myfile" name="myfile" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reference Records"><b>Reference Records</b></label>
                                <div class="static">Ref.Record</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <!-- Activity History -->
                        <div class="col-12 sub-head">
                            Record Signature
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit by"><b>Submit by</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submit On"><b>Submit On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Supervisor Review Complete By"><b>Supervisor Review Complete By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Supervisor Review Complete On"><b>Supervisor Review Complete On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Activate By"><b>Activate By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Activate On"><b>Activate On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reject Supplier By"><b>Reject Supplier By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reject Supplier On"><b>Reject Supplier On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Inactivate By"><b>Inactivate By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Inactivate On"><b>Inactivate On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancel By"><b>Cancel By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Cancel On"><b>Cancel On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Re Activate By"><b>Re Activate By</b></label>
                                <div class="static">Shaleen Mishra</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Re Activate On"><b>Re Activate On</b></label>
                                <div class="static">17-04-2023 11:12PM</div>
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
