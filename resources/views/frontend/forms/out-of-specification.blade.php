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
                <button class="cctablinks active" onclick="openCity(event, 'CCForm1')">OOS</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm2')">Initial Assessment</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm3')">Lab Investigation & Root Cause</button>
                <button class="cctablinks" onclick="openCity(event, 'CCForm4')">Signatures</button>
            </div>

            <!-- OOS Tab content -->
            <div id="CCForm1" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="originator">Originator</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Date Opened">Date Opened</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="group-input">
                                <label for="Assigned to">Assigned to</label>
                                <div class="static"></div>
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
                                <label for="Date Due">Date Due</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Date Occurred.">Date Occurred.</label>
                                <div class="static"></div>
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
                                <label for="Type..">Type..</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Facilities</option>
                                    <option>Other</option>
                                    <option>Stability</option>
                                    <option>Raw Materials</option>
                                    <option>Clinical Production Commercial Production</option>
                                    <option>Labeling</option>
                                    <option>Laboratory</option>
                                    <option>Utilities</option>
                                    <option>Validation</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Product Type">Product Type</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Device</option>
                                    <option>Drug</option>
                                    <option>Others</option>
                                    <option>Supplement</option>
                                    <option>Vaccine</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Test Result">Test Result</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Out of Specification (OOS) Test Result</option>
                                    <option>Accelerated Stability Testing</option>
                                    <option>In-Process Test</option>
                                    <option>Laboratory Error</option>
                                    <option>Original Sample</option>
                                    <option>Outlier Result</option>
                                    <option>Out Of Trend (OOT) Test Result</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Level of Failure">Level of Failure</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Laboratory Internally</option>
                                    <option>Sampling. Sample Transport and Storage</option>
                                    <option>Batch Record Review, Production </option>
                                    <option>Production Process</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Original Test Results">Original Test Results</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Limits / Specifications">Limits / Specifications</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Manufacturer">Manufacturer</label>
                                <select name="manufacturer">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Product/Material">
                                    Product/Material<button type="button" name="ann"
                                        onclick="add6Input('product_material')">+</button>
                                </label>
                                <table class="table table-bordered" id="product_material">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Product Name</th>
                                            <th>Batch No.</th>
                                            <th>Expiry Date</th>
                                            <th>Manufactured Date</th>
                                            <th>Disposition</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Department(s)">Department(s)</label>
                                <select multiple name="departments" placeholder="Select Departments" data-search="false"
                                    data-silent-initial-value-set="true" id="departments">
                                    <option value="piyush">-- Select --</option>
                                    <option value="piyush">Amit Guru</option>
                                    <option value="piyush">Amit Patel</option>
                                    <option value="piyush">Anshul Patel</option>
                                    <option value="piyush">Shaleen Mishra</option>
                                    <option value="piyush">Vikas Prajapati</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Related URLs">Related URLs</label>
                                <input type="url" name="link">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Off Site/On Site Manufacturing">Off Site/On Site Manufacturing</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Off Side</option>
                                    <option>On Side</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="OOS Phase">OOS Phase</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Phase I</option>
                                    <option>Phase II</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached Files">Attached Files</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Attached Picture">Attached Picture</label>
                                <input type="file" id="myfile" name="myfile">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Description">Description</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Comments">Comments</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="External Tests">External Tests</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Test Lab">Test Lab</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>QCM</option>
                                    <option>QCA</option>
                                    <option>QC GeN</option>
                                    <option>PCG</option>
                                    <option>Contract</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Initial Assessment content -->
            <div id="CCForm2" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Risk Factors
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Safety Impact Probability">Safety Impact Probability</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Low-Almost Improbable(1)</option>
                                    <option>Medium - Occasional (2)</option>
                                    <option>High-Frequent (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Safety Impact Severity">Safety Impact Severity</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Neglible (1)</option>
                                    <option>Marginal (2)</option>
                                    <option>Critical (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Legal Impact Probability">Legal Impact Probability</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Low-Almost Improbable(1)</option>
                                    <option>Medium - Occasional (2)</option>
                                    <option>High-Frequent (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Legal Impact Severity">Legal Impact Severity</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Neglible (1)</option>
                                    <option>Marginal (2)</option>
                                    <option>Critical (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Business Impact Probability">Business Impact Probability</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Low-Almost Improbable(1)</option>
                                    <option>Medium - Occasional (2)</option>
                                    <option>High-Frequent (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Business Impact Severity">Business Impact Severity</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Neglible (1)</option>
                                    <option>Marginal (2)</option>
                                    <option>Critical (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Revenue Impact Probability">Revenue Impact Probability</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Low-Almost Improbable(1)</option>
                                    <option>Medium - Occasional (2)</option>
                                    <option>High-Frequent (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Revenue Impact Severity">Revenue Impact Severity</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Neglible (1)</option>
                                    <option>Marginal (2)</option>
                                    <option>Critical (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Brand Impact Probability">Brand Impact Probability</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Low-Almost Improbable(1)</option>
                                    <option>Medium - Occasional (2)</option>
                                    <option>High-Frequent (3)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Brand Impact Severity">Brand Impact Severity</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Neglible (1)</option>
                                    <option>Marginal (2)</option>
                                    <option>Critical (3)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sub-head">
                        Calculated Risk and Further Actions
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Safety Impact Risk">Safety Impact Risk</label>
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
                                <label for="Legal Impact Risk">Legal Impact Risk</label>
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
                                <label for="Business Impact Risk">Business Impact Risk</label>
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
                                <label for="Revenue Impact Risk">Revenue Impact Risk</label>
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
                                <label for="Brand Impact Risk">Brand Impact Risk</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="sub-head">
                        Overall Assessment
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Impact">Impact</label>
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
                                <label for="Criticality">Criticality</label>
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
                                <label for="Impact Analysis">Impact Analysis</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Risk Analysis">Risk Analysis</label>
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
                    </div>
                    <div class="sub-head">
                        Geographic Information
                    </div>
                    <div class="row">
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
                                    <option></option>
                                    <option></option>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="City">City</label>
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
                                <label for="State/District">State/District</label>
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
                    </div>
                </div>
            </div>

            <!-- Lab Investigation & Root Cause content -->
            <div id="CCForm3" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="sub-head">
                        Investigation
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Lead Investigator">Lead Investigator</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Investigation Summary">Investigation Summary</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Conclusion">Conclusion</label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="sub-head">
                        Root Cause Analysis
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Root Cause Methodology">Root Cause Methodology</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Events and Casual Factors Charting</option>
                                    <option>Change Analysis</option>
                                    <option>Barrier Analysis</option>
                                    <option>Tree Diagrams</option>
                                    <option>Why-Why Chart</option>
                                    <option>Pareto Analysis</option>
                                    <option>Storytelling Method</option>
                                    <option>Fault Tree Analysis Failure Modes and Effect Analysis</option>
                                    <option>Tealitycharting</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Root Cause">
                                    Root Cause<button type="button" name="ann"
                                        onclick="add4Input('root_cause')">+</button>
                                </label>
                                <table class="table table-bordered" id="root_cause">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Root Cause Category</th>
                                            <th>Probability</th>
                                            <th>Manufacturing stage</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Root Cause Description ">Root Cause Description </label>
                                <textarea name="text"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="sub-head">
                        Test Information
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Original Test Results">Original Test Results</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Limits / Specifications">Limits / Specifications</label>
                                <input type="text" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="External Tests">External Tests</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Test Lab">Test Lab</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>QCM</option>
                                    <option>QCA</option>
                                    <option>QC GeN</option>
                                    <option>PCG</option>
                                    <option>Contract</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="group-input">
                                <label for="Action Plan">
                                    Action Plan<button type="button" name="ann"
                                        onclick="add4Input('action_plan')">+</button>
                                </label>
                                <table class="table table-bordered" id="action_plan">
                                    <thead>
                                        <tr>
                                            <th>Row #</th>
                                            <th>Action</th>
                                            <th>Responsible</th>
                                            <th>Deadline</th>
                                            <th>Item Static</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Has Batch been Rejected?">Has Batch been Rejected?</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Further Testing">Further Testing</label>
                                <select>
                                    <option>Enter Your Selection Here</option>
                                    <option>Yes</option>
                                    <option>No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signatures content -->
            <div id="CCForm4" class="inner-block cctabcontent">
                <div class="inner-block-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted By..">Submitted By..</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Submitted On">Submitted On</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reviewed By">Reviewed By</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Reviewed On">Reviewed On</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Plan Approved By">Plan Approved By</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Plan Approved On">Plan Approved On</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved By">Approved By</label>
                                <div class="static"></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="group-input">
                                <label for="Approved On">Approved On</label>
                                <div class="static"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        VirtualSelect.init({
            ele: '#departments'
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
