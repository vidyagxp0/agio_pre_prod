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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">Project</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Project Planning</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Risk Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Post Implementation</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm6')">Signatures</button>
            </div>

            <!-- Risk Management Tab content -->
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
                                <label for="Short Desc.">Short Desc.</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Assigned to">Assigned to</label>
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
                                <label for="Date Due">Date Due</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Sourcd of Risk">Source of Risk</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Audit</option>
                                    <option>Complaint</option>
                                    <option>Employee</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Type..">Type..</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Other</option>
                                    <option>Business Risk</option>
                                    <option>custumer-Related Risk(Complaint)</option>
                                    <option>Market</option>
                                    <option>Operational Risk</option>
                                    <option>Strategic Rick</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Department(s)">Department(s)</label>
                                <select multiple name="Departments" placeholder="Select Departments" data-search="false"
                                    data-silent-initial-value-set="true" id="Departments">
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
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Team Members">Team Members</label>
                                <select multiple name="Team_Members" placeholder="Select Team Members" data-search="false"
                                    data-silent-initial-value-set="true" id="Team_Members">
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
                                <label for="Priority Level">Priority Level</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Hige</option>
                                    <option>medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Zone">Zone</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Asia</option>
                                    <option>Europe</option>
                                    <option>Africa</option>
                                    <option>Central America</option>
                                    <option>South America</option>
                                    <option>Oceania</option>
                                    <option>North America</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Country">Country</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Test Option</option>
                                    <option>Test Option</option>
                                    <option>Test Option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="City">City</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Test Option</option>
                                    <option>Test Option</option>
                                    <option>Test Option</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Description">Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Comments">Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Risk Details content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Department(s)">Department(s)</label>
                                <select multiple name="Departments" placeholder="Select Departments" data-search="false"
                                    data-silent-initial-value-set="true" id="Departments">
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
                                <label for="Sourcd of Risk">Sourcd of Risk</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Audit</option>
                                    <option>Complaint</option>
                                    <option>Employee</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Site Name">Site Name</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>City MFR A</option>
                                    <option>City MFR B</option>
                                    <option>City MFR C</option>
                                    <option>Complex A</option>
                                    <option>Complex B</option>
                                    <option>Maerketing A</option>
                                    <option>Maerketing B</option>
                                    <option>Maerketing C</option>
                                    <option>Oceanside</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Building.">Building.</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                    <option>D</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Floor...">Floor...</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Room">Room</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Related Record">Related Record</label>
                                <div class="static">Ref.Record</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Related Equipment">Related Equipment</label>
                                <div class="static">Ref.Record</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Duration">Duration</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>2 hours</option>
                                    <option>4 hours</option>
                                    <option>8 hours</option>
                                    <option>16 hours</option>
                                    <option>24 hours</option>
                                    <option>36 hours</option>
                                    <option>72 hours</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Hazard">Hazard</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Confined Space</option>
                                    <option>Electrical</option>
                                    <option>Energy use</option>
                                    <option>Ergonomics</option>
                                    <option>Machine Guarding</option>
                                    <option>Material Storage</option>
                                    <option>Material use</option>
                                    <option>Pressure</option>
                                    <option>Thermal</option>
                                    <option>Water use</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Room">Room</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Automation</option>
                                    <option>Biochemistry</option>
                                    <option>Blood Collection</option>
                                    <option>Enter Yo</option>
                                    <option>Buffer Preparation</option>
                                    <option>Bulk Fill</option>
                                    <option>Calibration</option>
                                    <option>Component Manufacturing</option>
                                    <option>Computer</option>
                                    <option>Computer / Automated Systems</option>
                                    <option>Despensing Donor Suitability</option>
                                    <option>Filling</option>
                                    <option>Filtration</option>
                                    <option>Formulation</option>
                                    <option>Incoming QA</option>
                                    <option>Hazard</option>
                                    <option>Laboratory</option>
                                    <option>Laboratory Support Facility</option>
                                    <option>Enter Your</option>
                                    <option>Lot Release</option>
                                    <option>Manufacturing</option>
                                    <option>Materials Management</option>
                                    <option>Room</option>
                                    <option>Operations</option>
                                    <option>Packaging</option>
                                    <option>Plant Engineering</option>
                                    <option>Enter Your Sele</option>
                                    <option>Njown</option>
                                    <option>Powder Filling</option>
                                    <option>Process Development</option>
                                    <option>Product Distribution</option>
                                    <option>Product Testing</option>
                                    <option>Production Purification</option>
                                    <option>QA</option>
                                    <option>QA Laboratory Quality Control</option>
                                    <option>Quality Control / Assurance</option>
                                    <option>Sanitization</option>
                                    <option>Shipping/Distribution Storage/Distribution</option>
                                    <option>Storage and Distribution</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Regulatory Climate">Regulatory Climate</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>0. No significant regulatory issues affecting operation</option>
                                    <option>1. Some regulatory or enforcement changes potentially affecting operation are
                                        anticipated </option>
                                    <option>2. A few regulatory or enforcement changes affect operations</option>
                                    <option>3. Regulatory and enforcement changes affect operation</option>
                                    <option>4. Significant programatic regulatory and enforcement changes affect operation
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Number of Employees">Number of Employees</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Risk Management Strategy">Risk Management Strategy</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Accept</option>
                                    <option>Avoid the Risk</option>
                                    <option>Mitigate</option>
                                    <option>Transfer</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Risk Assessment content -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">

                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Impact">Impact</label>
                                <select>
                                    <option>High</option>
                                    <option>medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Post Implementation content -->
            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Start date">Actual Start Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual End Date">Scheduled End Date</label>
                                <input type="date" name="date">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Taken">Action Taken</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Exective Summary">Exective Summary</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Man-Hours">Actual Man-Hours</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Actual Cost">Actual Cost</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signatures content -->
            <div id="CCForm6" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted By..">Submitted By..</label>
                                <div class="static">person data field</div>
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
                                <label for="Approved By">Approved By</label>
                                <div class="static">person data field</div>
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
                                <label for="Completed By">Completed By</label>
                                <div class="static">person data field</div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Completed On">Completed On</label>
                                <div class="static">17-04-2023 11:12PM</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        VirtualSelect.init({
            ele: '#Departments, #Team_Members'
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
